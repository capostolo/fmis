<?php namespace Fmis\Controllers;

use CodeIgniter\Shield\Authorization\AuthorizationException;

class UserFarmerController extends BaseController
{
  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->farmerModel = new \Fmis\Models\FarmerModel();
    $this->user = auth()->user();
  }
  
  /**
   * List farmers that can be linked to users based on matching AFM values
   * Only accessible by admins and advisors
   */
  public function index()
  {
    // Check permissions - only admins and advisors can access
    if (!$this->user->inGroup('admin') && !$this->user->inGroup('advisor')) {
      throw new AuthorizationException('Access denied');
    }
    
    // Get unlinked farmers that can be matched with users by AFM
    if ($this->user->inGroup('admin')) {
      // Admins can see all farmers
      $data['matchableFarmers'] = $this->farmerModel->getFarmerWithoutUser();
    } else {
      // Advisors can only see farmers they manage
      $data['matchableFarmers'] = $this->farmerModel->getFarmerWithoutUser(['advisor_id' => user_id()]);
    }    
    return view('\Fmis\Views\Farmer\match_user', $data);
  }
  
  /**
   * Link a user to a farmer
   */
  public function linkUserToFarmer()
  {
    // Check permissions - only admins and advisors can access
    if ($this->request->isAJAX() && ($this->user->inGroup('admin') || $this->user->inGroup('advisor'))) {
  
      $postdata = $this->request->getPost();    
      $userId = $postdata['user_id'];
      $farmerId = $postdata['farmer_id'];
      
      // Get the farmer
      $farmer = $this->farmerModel->find($farmerId);
      
      // For advisors, ensure they are only linking farmers they manage
      if ($this->user->inGroup('advisor') && $farmer->advisor_id != user_id()) {
        $response = [
          'status' => 'failure',
          'message' => 'Δεν έχετε πρόσβαση σε αυτόν τον παραγωγό'
        ];
        return $this->response->setJSON($response);
      }
      
      // Link user to farmer
      $farmer->user_id = $userId;
      
      if ($this->farmerModel->save($farmer)) {
        // Add user to user group if needed
        $users = auth()->getProvider();
        $user = $users->findById($userId);
        $user->addGroup('user');      
        $response = [
          'status' => 'success',
          'message' => 'Ο χρήστης συνδέθηκε επιτυχώς με τον παραγωγό'
        ];
      } else {
        $response = [
          'status' => 'failure',
          'message' => 'Σφάλμα κατά τη σύνδεση του χρήστη με τον παραγωγό'
        ];
      }
      return $this->response->setJSON($response);
    }

  }
  
  
  /**
   * Unlink a user from a farmer
   */
  public function unlinkUserFromFarmer($farmerId)
  {
    // Check permissions - only admins and advisors can access
    if (!$this->user->inGroup('admin') && !$this->user->inGroup('advisor')) {
      throw new AuthorizationException('Access denied');
    }
    
    // Check if farmer exists
    $farmer = $this->farmerModel->find($farmerId);
    
    if (!$farmer) {
      return redirect()->back()->with('error', 'Ο παραγωγός δεν βρέθηκε');
    }
    
    // For advisors, ensure they are only unlinking farmers they manage
    if ($this->user->inGroup('advisor') && $farmer->advisor_id != user_id()) {
      return redirect()->back()->with('error', 'Δεν έχετε πρόσβαση σε αυτόν τον παραγωγό');
    }
    
    // Check if farmer is linked to a user
    if (!$farmer->user_id) {
      return redirect()->back()->with('error', 'Ο παραγωγός δεν είναι συνδεδεμένος με χρήστη');
    }
    
    // Unlink user from farmer
    $farmer->user_id = 0;
    
    if ($this->farmerModel->save($farmer)) {
      return redirect()->to('fmis/farmer')->with('message', 'Ο χρήστης αποσυνδέθηκε επιτυχώς από τον παραγωγό');
    } else {
      return redirect()->back()->with('error', 'Σφάλμα κατά την αποσύνδεση του χρήστη από τον παραγωγό');
    }
  }
}
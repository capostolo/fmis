<?php namespace Fmis\Controllers;

class PruningTypeController extends BaseController
{

  public function __construct()
  {
    helper(['form', 'url', 'session']);
    $this->model = new \Fmis\Models\PruningTypeModel();
  }
  
  public function index()
  {    
    if(session()->get('pruning_type_where')){
      $data['rows'] = $this->model->modelList(['pruning_type_where' => session()->get('pruning_type_where')]);
    }
    else{
      $data['rows'] = $this->model->modelList();
    }
    return view('\Fmis\Views\Pruningtype\list', $data);
  }

  public function newItem()
  {    
    
    
    
    session()->remove('pruning_type_id');
    $Ecoscheme = new \Fmis\Models\EcoschemeModel();
  	$data['ecoscheme'] = $Ecoscheme->findAll();
    return view('\Fmis\Views\Pruningtype\add', $data ?? array());
  }

  public function showItem($id)
  {    
    
    
    
    $Ecoscheme = new \Fmis\Models\EcoschemeModel();
  	$data['ecoscheme'] = $Ecoscheme->findAll();
    $data['row'] = $this->model->find($id);
    if($data['row']){
      session()->set('pruning_type_id', $id);
    }
    return view('\Fmis\Views\Pruningtype\update', $data);
  }

  public function saveItem()
  {   
    $postdata = $this->request->getPost();
    
    $item = new \Fmis\Entities\PruningTypeEntity();
    $item->fill($postdata);
    if(session()->get('pruning_type_id')){
      $item->id = session()->get('pruning_type_id');
    }
    if($this->model->save($item)){
      if($this->model->getInsertID() != 0){
        $item_id = $this->model->getInsertID();
        
        
      }
      else {
        $item_id = $item->id;
        
        
        
      }
      
      return redirect()->to('fmis/pruning-type/'.$item_id)->with('message', 'Τα στοιχεία ενημερώθηκαν με επιτυχία!');
    }
    else {
      return redirect()->back()->withInput()->with('error', "Σφάλμα.");
    }

  }

  public function deleteItem()
  {    
    $id = $this->request->getPost('item_id');
    try {
        // Check if record exists
        $record = $this->model->find($id);
        if (!$record) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Record not found'
            ]);
        }

        // Delete the record
        if ($this->model->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Record deleted successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error deleting record'
            ]);
        }
    } catch (\Exception $e) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
  }
}

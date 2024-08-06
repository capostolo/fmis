<?php namespace Fmis\Filters;

use Config\Services;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RestrictParcel implements FilterInterface
{
	/**
	 * Do whatever processing this filter needs to do.
	 * By default it should not return anything during
	 * normal execution. However, when an abnormal state
	 * is found, it should return an instance of
	 * CodeIgniter\HTTP\Response. If it does, script
	 * execution will end and that Response will be
	 * sent back to the client, allowing for error pages,
	 * redirects, etc.
	 *
	 * @param \CodeIgniter\HTTP\RequestInterface $request
	 * @param array|null                         $params
	 *
	 * @return mixed
	 */
	public function before(RequestInterface $request, $params = null)
	{
    $allow = false;
    $user = auth()->user();    
    $appModel = new \Fmis\Models\FarmerModel();
    if ($user->inGroup('advisor')){
      $my_apps = $appModel->where(['advisor_id' => user_id()])
                    ->findAll();
    }
    else if ($user->inGroup('farmer')){
      $my_apps = $appModel->where(['user_id' => user_id()])
                    ->findAll();
    }
    else if ($user->inGroup('admin') || $user->inGroup('test')){
      return;
    }
    $parcelModel = new \Fmis\Models\ParcelModel();
    $uri = $request->getServer(['REQUEST_URI']);
    $segment = explode("/", $uri['REQUEST_URI']);
    $parcel = end($segment);
    $parcel_data = $parcelModel->where('id', $parcel)->first();
    log_message('debug', 'parcel:'.$parcel.', farmer:'.$parcel_data->farmer_id);
    foreach($my_apps as $a){
    log_message('debug', 'farmer_id:'.$a->id.', farmer:'.$parcel_data->farmer_id);
      if ($a->id == $parcel_data->farmer_id){
        $allow = true;
      }
    }

    if(!$allow){
      return redirect()->back()->withInput()->with('error', lang('Fmis.no_access'));
    }
    return;

	}

	//--------------------------------------------------------------------

	/**
	 * Allows After filters to inspect and modify the response
	 * object as needed. This method does not allow any way
	 * to stop execution of other after filters, short of
	 * throwing an Exception or Error.
	 *
	 * @param \CodeIgniter\HTTP\RequestInterface  $request
	 * @param \CodeIgniter\HTTP\ResponseInterface $response
	 * @param array|null                          $arguments
	 *
	 * @return void
	 */
	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{

	}

	//--------------------------------------------------------------------
}

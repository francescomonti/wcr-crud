<?php
namespace Wcr\Crud\Http;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Event;

class CrudController extends Controller
{
    public $indexView = 'WcrCrud::index';
    public $createView = 'WcrCrud::create';
    public $editView = 'WcrCrud::edit';
    public $showView = 'WcrCrud::show';
    public $_listItem = 'WcrCrud::partials/_listItem';
    public $_showItem = 'WcrCrud::partials/_showItem';
    public $def = array(
        'item' => 'Item',
        'items' => 'Items',
        'tableFields' => array('id')
    );
    public $opt = array();

    function __construct(){
        $this->model = new $this->modelClass;
        $controllerName = explode('\\', get_class($this));

        $this->def['controller'] = end($controllerName);
        $this->def['index'] = action($this->def['controller'].'@index');
        $this->def['create'] = action($this->def['controller'].'@create');
        $this->def['partials'] = array(
            'listItem' => $this->_listItem,
            'showItem' => $this->_showItem,
            'itemFields' => str_replace('Controller', '', $this->def['controller']).'/fields',
        );
        $this->opt = array_merge($this->def, $this->opt);
    }

    public function index (){
        $this->opt['action'] = 'List';
        return view($this->indexView, ['resources' => $this->getResources(), 'opt' => $this->opt]);
    }

    public function create (){
        $this->opt['action'] = 'Create';
        return view($this->createView, ['opt' => $this->opt]);
    }

    public function store (){
        $validator = Validator::make(Input::all(), $this->validateRules);

        if($validator->fails()){
            return Redirect::to($this->opt['create'])
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }else{
            $resource = $this->model;
            foreach( $this->acceptedAttributes as $a ){
                $resource->$a = Input::get($a);
            }
            $resource->save();
            Event::fire('crud.created', $resource);
            Session::flash('message', 'Successfully created entity!');
            return Redirect::action($this->opt['controller'].'@index');
        }
    }

    public function show ($id){
        $this->opt['action'] = 'Show';
        $resource = $this->getResource($id);
        return view($this->showView, ['resource' => $resource,'opt' => $this->opt]);
    }
    
    public function edit ($id){
        $this->opt['action'] = 'Edit';
        $resource = $this->getResource($id);
        return view($this->editView, ['resource' => $resource,'opt' => $this->opt]);
    }

    public function update ($id){
        $validator = Validator::make(Input::all(), $this->validateRules);

        if($validator->fails()){
            return Redirect::to($this->opt['create'])
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }else{
            $resource = $this->getResource($id);
            foreach( $this->acceptedAttributes as $a ){
                $resource->$a = Input::get($a);
            }
            $resource->save();
            Event::fire('crud.updated', $resource);
            Session::flash('message', 'Successfully created entity!');
            return Redirect::action($this->opt['controller'].'@index');
        }
    }

    public function destroy ($id){
        $resource = $this->getResource($id);
        Event::fire('crud.deleted', $resource);
        $resource->delete();
        Session::flash('message', 'Successfully deleted entity!');
        return Redirect::action($this->opt['controller'].'@index');
    }

    private function getResources (){
        //return $this->model->all(); // all obj for admin
        return Auth::user()->listOf($this->modelClass); // also owned resources
    }

    private function getResource ($id){
        return $this->model->find($id);
    }

}

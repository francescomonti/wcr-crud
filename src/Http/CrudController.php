<?php
namespace Wcr\Crud\Http;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Event;

class CrudController extends Controller
{
    public $indexView = 'WcrCrud::index';
    public $createView = 'WcrCrud::create';
    public $editView = 'WcrCrud::edit';
    public $showView = 'WcrCrud::show';
    public $opt = array(
        'item' => 'Item',
        'items' => 'Items',
        'tableFields' => array('id')
    );

    function setController(){
        $controllerName = explode('\\', get_class($this));
        $this->opt['controller'] = end($controllerName);
        $this->opt['index'] = action($this->opt['controller'].'@index');
        $this->opt['create'] = action($this->opt['controller'].'@create');
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
        return $this->model->all();
    }

    private function getResource ($id){
        return $this->model->find($id);
    }

}

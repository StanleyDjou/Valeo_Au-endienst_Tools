<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog;

use App\Models\Category;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $showModal = false;

    public $date = null;
    public $isEditMode = false;

    public ?Blog $blog;

    public $image = null;



    public $title = "";

    public $type = "";

    public $description = "";

    public $category_id = "";

    public $path = null;

    public $db_path = null;



    protected $listeners = [
        'load'=>'load'
    ];

    public function mount($type){
        $this->type = $type;
    }

    public function load(?Blog $blog){
        $this->blog = $blog;
        if(isset($this->blog) && $this->blog->exists){
            $this->isEditMode = true;
            $this->title = $blog->title;
            $this->type = $blog->type;
            $this->path = $blog->path;
            $this->description = $blog->description;
            $this->db_path = $blog->path;
            $this->date = $blog->created_at;
            $this->category_id = $blog->category_id;
        }else{
            $this->isEditMode = false;
        }
        $this->showModal = true;
    }

    public function render()
    {
        $categories = Category::blog();
        return view('livewire.blog.edit', ['categories'=>$categories]);
    }

    protected $rules = [
        "title" => 'required',
        "category_id" => 'required',
        "description" => 'required',
        "type" =>  'required',

    ];

    public function save(){
        $data = $this->withValidator(function (\Illuminate\Validation\Validator $validator) {
            $validator->after(function (Validator $validator) {
                if(!$this->isEditMode && !isset($this->image)){
                    $validator->errors()->add('image', 'The Image field is required.');
                    return;
                }
                if(!$this->isEditMode && !isset($this->path ) && $this->type == 'video'){
                    $validator->errors()->add('path', 'The url field is required');
                    return;
                }
            });

        })->validate();

        $data["posted_by"] = auth('admin')->user()->id;
        if($this->isEditMode){
            if(isset($this->image)){
                $data["image"] = str_replace('public/', '', $this->image->store('public/images'));
                unlink('storage/'. $this->blog->image);
            }
            if(isset($this->path) && $this->type == 'video'){
                $data["path"] = $this->path;
            }
            if(isset($this->date)){
                $data['created_at'] = $this->date;
            }
            $this->blog->update($data);
            $this->emit("success", "Blog updated successfully!");

        }else{
            $data["image"] = str_replace('public/', '', $this->image->store('public/images'));
            if($this->type == 'podcast'){
                $data["path"] = $this->path;
            }
            if($this->type == 'video'){
                $data["path"] = $this->path;
            }
            if(isset($this->date)){
                $data['created_at'] = $this->date;
            }
            $this->blog->create($data);
            $this->emit("success", "Blog created successfully!");
        }
        $this->emit("blogCreated");
        $this->showModal = false;

        $this->title= "";
        $this->path = null;
        $this->image = null;
        $this->category_id = null;
        $this->description= "";
        $this->date = null;


    }


    public function updatedShowModal($value){
        if(!$value){
            $this->title= "";
            $this->path = null;
            $this->image = null;
            $this->category_id = null;
            $this->description= "";
            $this->date = null;
            $this->emit("blogCreated");
            $this->showModal = false;
        }
    }
}

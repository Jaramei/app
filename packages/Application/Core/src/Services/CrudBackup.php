<?php namespace Application\Core\Services;

use Auth;
use Redirect;
use Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class Crud {

    protected $request;


    function __construct(Request $request)

    {

        $this->request = $request;
    }

    public function store($request) {

       //   dd($request);

        if ($request->hasFile('upload')) {

            if(!Storage::disk('public')->has($request->segment(2))) {

                Storage::disk('public')->makeDirectory($request->segment(2));

                if(config('Offers.image_size')) {

                    Storage::disk('public')->makeDirectory($request->segment(2).'/thumb');

                }

            }

            $request->file('upload')->storeAs('public/'.$request->segment(2),$request->file('upload')->getClientOriginalName());
            $request->merge(['photo'=>$request->file('upload')->getClientOriginalName()]);

            if(config('Offers.image_size')) {

                $this->imageSize($request);

            }

            Session::flash('success-file', 'This a picture was uploaded.');


        }

        if(!$request->has('active')) {$request->merge(['active'=>0]);}
        $request->merge(['slug' => str_slug($request->name)]);
        $request->merge(['user_id' => Auth::user()->id,'lang_id'=> $request->session()->get('locale-id')]);
        $request->except('_token');

        return $request;

    }

    public function update($id,$model,$request) {

        if ($request->hasFile('upload')) {

            if ($model->getById($id)->photo) {

                Storage::disk('public')->delete($request->segment(2).'/' . $model->getById($id)->photo);

            }

            $request->file('upload')->storeAs('public/'.$request->segment(2),$request->file('upload')->getClientOriginalName());
            $request->merge(['photo'=>$request->file('upload')->getClientOriginalName()]);

            if(config('Offers.image_size')) {

                $this->imageSize($request);

            }

            Session::flash('success-file', 'This a picture was uploaded.');

        }


        if(!$request->has('active')) {$request->merge(['active'=>0]);}
        $request->merge(['slug' => str_slug($model->getById($id)->name)]);

        $request->request->remove('_method');
        $request->request->remove('_token');

        return $request;


    }

    private function imageSize($request) {


        Image::make(Storage::disk('public')->get(ucfirst($request->segment(2)).'/'.$request->file('upload')->getClientOriginalName()))
            ->resize(config('Offers.image_size.thumb.w'), null,function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg')
            ->save(public_path('/storage/'.$request->segment(2).'/thumb/'.$request->file('upload')->getClientOriginalName()), 60);


        Image::make(Storage::disk('public')->get(ucfirst($request->segment(2)).'/'.$request->file('upload')->getClientOriginalName()))
            ->resize(config('Offers.image_size.orginal.w'), config('Offers.image_size.orginal.h'),function ($constraint) {
            })->encode('jpg')
            ->save(public_path('/storage/'.$request->segment(2).'/'.$request->file('upload')->getClientOriginalName()), 60);

    }


    public function delete($item) {

        if(array_key_exists('photo',$item->toArray()))

        {

            if(Storage::disk('public')->exists($item->getTable().'/'.$item->photo)) {

                Storage::disk('public')->delete($item->getTable().'/'.$item->photo);

                foreach(Storage::disk('public')->directories($item->getTable()) as $folder) {

                    Storage::disk('public')->delete($folder.'/'.$item->photo);

                }

            }

        }

    }



}
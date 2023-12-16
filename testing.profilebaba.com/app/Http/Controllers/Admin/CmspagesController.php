<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cmspages;
use App\PageImage;
use DB;
use Image;
class CmspagesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $items = Cmspages::orderby('id', 'DESC')->get();
        return view('admin.pages.index', array('items' => $items));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $items = Cmspages::orderby('id', 'DESC')->get();
        return view('admin.pages.create', array('items' => $items));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // dd($request->all());
        $records = $request->all();
        $id = Cmspages::create($records)->id;
        // --------- Inserting Page Images-------------- //
        // $page_images = array();
        // $images = $request->image;
        // if ($images) {
        //     if (count($images) > 0) {
        //         foreach ($images as $k => $image) {
        //             if ($request->hasFile('image')) {
        //                 if (!empty($request->file('image'))) {
        //                     $fileName = $request->file('image') [$k]->getClientOriginalName();
        //                     $fileName = time() . "_" . $fileName;
        //                     $image = $request->file('image') [$k];
        //                     $page_images[] = array('id' => $id, 'image' => $fileName);
        //                     $directory = base_path('/uploads/cmspages/');
        //                     $imageUrl = $directory . $fileName;
        //                     Image::make($image)->save($imageUrl);
        //                     //column name
                            
        //                 }
        //             }
        //         }
        //     }
        // } 
        // image count if close
        // PageImage::insert($page_images);
        // ----------------------- //
        return \Redirect::route('admin_page_create')->with('message', 'Added Successfully ! ');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $item = Cmspages::find($id);
        return view('admin.pages.edit', array('item' => $item));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, ['title' => 'required', ]);
        $item = Cmspages::find($id);
        $item->title = $request->title;
        $item->body = $request->body;
        $item->slug = $request->slug;
        $item->heading = $request->heading;
        $item->meta_title = $request->meta_title;
        $item->meta_description = $request->meta_description;
        $item->meta_keywords = $request->meta_keywords;
        $item->status = $request->status;
        $item->save();
        if (!empty($request->file('image'))) {
            DB::table('pageimage')->where('id', $id)->delete();
        }

        // $page_images = array();
        // $images = $request->image;
        // if ($images) {
        //     if (count($images) > 0) {
        //         foreach ($images as $k => $image) {
        //             if ($request->hasFile('image')) {
        //                 if (!empty($request->file('image'))) {
        //                     $fileName = $request->file('image') [$k]->getClientOriginalName();
        //                     //dd($fileName);
        //                     $fileName = time() . "_" . $fileName;
        //                     //upload
        //                     $image = $request->file('image') [$k];
        //                     $page_images[] = array('id' => $id, 'image' => $fileName);
        //                     $directory = base_path('/uploads/cmspages/');
        //                     $imageUrl = $directory . $fileName;
        //                     Image::make($image)->save($imageUrl);
        //                     //column name
                            
        //                 }
        //             }
        //         }
        //     }
        // } 
        // image count if close
        // PageImage::insert($page_images);
        // redirect
        return \Redirect::route('admin_page_edit', array('cmspage' => $id))->with('message', 'Successfully Updated!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Cmspages::Destroy($id);
        return \Redirect::route('admin_page')->with('message', 'Successfully Deleted!');
    }
    function page_list($parentid = 0, $space = '') {
        //echo ($selected_cid);die();
        $pages = Cmspages::where('parentid', $parentid)->get();
        $count = count($pages);
        if ($parentid == 0) {
            $space = '';
        } else {
            $space.= "--";
        }
        if ($count > 0) {
            foreach ($pages as $page) {
                //echo $selected_cid." : ".$category->cid."<br>";
                echo "<option  value='" . $page->id . "'>" . $space . $page->title . "</option>";
                $this->page_list($page->id, $space);
            }
        }
    }
    function page_edit_list($parentid, $space, $eid) {
        //echo ($selected_cid);die();
        $pages = Cmspages::where('parentid', $parentid)->get();
        $count = count($pages);
        //dd($count);
        if ($parentid == 0) {
            $space = '';
        } else {
            $space.= "--";
        }
        if ($count > 0) {
            foreach ($pages as $page) {
                if ($page->id == $eid) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                //echo $selected_cid." : ".$category->cid."<br>";
                echo "<option " . $selected . " value='" . $page->id . "'>" . $space . $page->title . "</option>";
                $this->page_list($page->id, $space);
            }
        }
    }
    function remove_page_image(request $request) {
        $pageimageid = $request->pageimageid;
        PageImage::Destroy($pageimageid);
        echo 1;
    }
}
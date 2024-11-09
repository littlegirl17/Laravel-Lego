<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerImages;
use Illuminate\Http\Request;

class BannerAdminController extends Controller
{
    private $bannerModel;
    private $bannerImageModel;

    public function __construct()
    {
        $this->bannerModel = new Banner();
        $this->bannerImageModel = new BannerImages();
    }
    public function banner()
    {
        $bannerImages = $this->bannerImageModel->bannerImageAll();
        $bannerName = $this->bannerModel->bannerName();
        $filter_name = '';


        return view('admin.banner', compact('bannerImages', 'bannerName', 'filter_name'));
    }

    public function bannerAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->hasFile('image_desktop') || $request->hasFile('image_mobile')) {
                $image_desktops = $request->file('image_desktop');
                $image_mobiles = $request->file('image_mobile');

                foreach ($image_desktops as $index => $image) {
                    $bannerImage = new BannerImages();
                    $bannerImage->banner_id = $request->banner_id;
                    $bannerImage->status = $request->status[$index];
                    $bannerImage->sort_order = $request->sort_order[$index];
                    $bannerImage->title = $request->title[$index];
                    $bannerImage->link_tab = $request->link_tab[$index];
                    $bannerImage->content_button = $request->content_button[$index];
                    $bannerImage->description = $request->description[$index];


                    if ($image->isValid()) {
                        $imageName = "{$bannerImage->id}" . uniqid() . "_desktop_{$index}.{$image->getClientOriginalExtension()}";

                        $image->move(public_path('img/'), $imageName);

                        $bannerImage->image_desktop =  $imageName;
                    }


                    if (isset($image_mobiles[$index]) && $image_mobiles[$index]->isValid()) {
                        $imageMobile = $image_mobiles[$index];
                        $imageName = "{$bannerImage->id}" . uniqid() . "_mobile_{$index}.{$imageMobile->getClientOriginalExtension()}";
                        $imageMobile->move(public_path('img/'), $imageName);
                        $bannerImage->image_mobile =  $imageName;
                    }
                    $bannerImage->save();
                }
            }
            return redirect()->route('banner')->with('success', 'Thêm hình ảnh thành công');
        }
        $bannerName = $this->bannerModel->bannerName();
        return view('admin.bannerAdd', compact('bannerName'));
    }

    public function bannerEdit($id)
    {
        $bannerImage = $this->bannerImageModel->findOrFail($id);
        $bannerName = $this->bannerModel->bannerName();

        return view('admin.bannerEdit', compact('bannerImage', 'bannerName'));
    }

    public function bannerUpdate(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $bannerImage = $this->bannerImageModel->findOrFail($id);

            $bannerImage->banner_id = $request->banner_id;
            $bannerImage->status = $request->status;
            $bannerImage->sort_order = $request->sort_order;
            $bannerImage->title = $request->title;
            $bannerImage->link_tab = $request->link_tab;
            $bannerImage->content_button = $request->content_button;
            $bannerImage->description = $request->description;
            $bannerImage->save();

            if ($request->hasFile('image_desktop')) {
                $imageDesktop = $request->file('image_desktop');

                $imageName = "{$bannerImage->id}" . uniqid() . "_desktop_.{$imageDesktop->getClientOriginalExtension()}";

                $imageDesktop->move(public_path('img/'), $imageName);

                $bannerImage->image_desktop = $imageName;
            }

            if ($request->hasFile('image_mobile')) {
                $imageMobile = $request->file('image_mobile');

                $imageName = "{$bannerImage->id}" . uniqid() . "_mobile_.{$imageMobile->getClientOriginalExtension()}";

                $imageMobile->move(public_path('img/'), $imageName);

                $bannerImage->image_mobile = $imageName;
            }

            $bannerImage->save();

            return redirect()->route('banner')->with('success', 'Cập nhật hình ảnh thành công');
        }
    }

    public function bannerDeleteCheckbox(Request $request)
    {
        $banner_ids = $request->input('banner_id');
        if ($banner_ids) {
            foreach ($banner_ids as $itemID) {
                $bannerImage = $this->bannerImageModel->findOrFail($itemID);
                $bannerImage->delete();
            }
            return redirect()->route('banner')->with('success', 'Xóa hình ảnh thành công');
        }
    }

    public function bannerUpdateStatus(Request $request, $id)
    {
        $bannerImage = $this->bannerImageModel->findOrFail($id);
        $bannerImage->status = $request->status;
        $bannerImage->save();
        return response()->json(['success' => true]);
    }

    public function bannerSearch(Request $request)
    {
        $filter_name = $request->input('filter_name');
        $filter_status = $request->input('filter_status');
        $bannerImages = $this->bannerImageModel->searchBanner($filter_name, $filter_status);

        $bannerName = $this->bannerModel->bannerName();
        return view('admin.banner', compact('bannerName', 'filter_name', 'bannerImages'));
    }
    /*---------------------------------------------------------------------------------------------------------------------*/
    public function bannerManage()
    {
        $banners = $this->bannerModel->banners();
        return view('admin.bannerManage', compact('banners'));
    }

    public function bannerManageAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $banner = new Banner();
            $banner->name = $request->name;
            $banner->position = $request->position;
            $banner->status = $request->status;
            $banner->save();
            return redirect()->route('bannerManage')->with('success', 'Thêm vị trí hình ảnh thành công');
        }
        return view('admin.bannerManageAdd');
    }

    public function bannerManageEdit($id)
    {
        $bannner = $this->bannerModel->findOrFail($id);
        return view('admin.bannerManageEdit', compact('bannner'));
    }

    public function bannerManageUpdate(Request $request, $id)
    {
        $banner = $this->bannerModel->findOrFail($id);
        $banner->name = $request->name;
        $banner->position = $request->position;
        $banner->status = $request->status;

        $banner->save();
        return redirect()->route('bannerManage')->with('success', 'Cập nhất vị trí hình ảnh thành công');
    }

    public function bannerManageDeleteCheckbox(Request $request)
    {
        $banner = $request->input('banner_id');
        if ($banner) {
            foreach ($banner as $itemID) {
                $banner = $this->bannerModel->findOrFail($itemID);
                $countBannerImages = $this->bannerImageModel->countBannerImages($itemID);
                if ($countBannerImages > 0) {
                    return redirect()->route('bannerManage')->with('error', ' Cảnh báo: Vị trí hình ảnh này không thể xóa vì nó hiện được chỉ định cho ' . $countBannerImages . ' hình ảnh!');
                } else {
                    $banner->delete();
                }
            }
            return redirect()->route('bannerManage')->with('success', 'Xóa vị trí hình ảnh thành công.');
        }
    }

    public function bannerManageUpdateStatus(Request $request, $id)
    {
        $banner = $this->bannerModel->findOrFail($id);
        $banner->status = $request->status;
        $banner->save();
        return response()->json(['success' => true]);
    }
}

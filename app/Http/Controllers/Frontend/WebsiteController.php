<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BlogCategory;
use App\Models\Brand;
use App\Models\FeatureCategory;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ServiceAds;
use App\Models\StaticBanner;
use App\Models\Subscriber;
use App\Models\SupportMessage;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home(): Factory|View|Application
    {
        $data = array();
        $data['featuresProducts'] = Product::with('color', 'category', 'size')
                    ->where('product_featured', 1)
                    ->where('product_active', 1)
                    ->where('product_status', 1)
                    ->orderBy('id', 'DESC')
                    ->limit(12)
                    ->get();
        $data['categories'] = ProductCategory::with('products.color','products.size')->where('pc_active', 1)
            ->where('pc_status', 1)
            ->where('pc_feature', 1)
            ->orderBy('pc_orderby', 'ASC')
            ->limit(5)
            ->get();
        $data['headerCategory'] = FeatureCategory::where('status', 1)
        ->orderBy('order_by', 'ASC')
        ->get();
        $data['banners'] = Banner::where('banner_publish', 1) ->where('banner_status', 1)->get();
        $data['serviceAds'] =  ServiceAds::where('sa_status', 1)->limit(3)->get();
        $data['staticHeader'] = StaticBanner::where('sb_status', 1)
            ->where('sb_banner_type', 'header')
            ->limit(3)
            ->get();
        $data['staticFooter'] = StaticBanner::where('sb_status', 1)
            ->where('sb_banner_type', 'footer')
            ->limit(4)
            ->get();
        // $data['banners'] = Banner::where('banner_status', 1)->limit(5)->get();

        return view('frontend.home', $data);
    }

    public function search(Request $request): Factory|View|Application
    {
        $request->validate([
            'search' => 'required',
        ], [
            'search.required' => 'Please Enter Your Search Keyword',
        ]);
        $searchTerm = $request->search;
        $products = Product::with('category', 'color', 'size')->where('product_name', 'LIKE', '%'.$searchTerm.'%')
                        ->orWhere('product_code', 'LIKE', '%'.$searchTerm.'%')
                        ->paginate(10);
        return view('frontend.pages.search', compact('products', 'searchTerm'));
    }

    public function page($page_url): Factory|View|Application
    {
        $page = Page::where('page_status', 1)->where('page_url', $page_url)->firstOrFail();
        if (!$page) {
            abort(404);
        }
        return view('frontend.pages.page', compact('page'));
    }
    public function allCategories(): Factory|View|Application
    {
        $categories = ProductCategory::where('pc_status', 1)->where('pc_active', 1)->get();
        return view('frontend.pages.categories.allCategory', compact('categories'));
    }

    public function singleCategory($url): Factory|View|Application
    {
        $category = ProductCategory::where('pc_status', 1)->where('pc_url', $url)->firstOrFail();
        if (!$category) {
            abort(404);
        }
        $products = $category->products()->where('product_active', 1)->where('product_status', 1)->paginate(18);
        return view('frontend.pages.categories.singleCategory', compact('category', 'products'));
    }

    // PRODUCT FUNCTION
    public function productView($product_url): Factory|View|Application
    {
        $product = Product::with('color', 'size')
            ->where('product_active', 1)
            ->where('product_status', 1)
            ->where('product_url', $product_url)->firstOrFail();
        return view('frontend.pages.productView', compact('product'));
    }

    public function subscriber(Request $request): RedirectResponse
    {
        $request->validate([
            'subscribe_email' => 'required|email|unique:subscribers,subscribe_email',
        ], [
            'subscribe_email.required' => 'Please Enter Your Email Address',
            'subscribe_email.email' => 'Please Enter Valid Email Address',
            'subscribe_email.unique' => 'This Email Address Already Subscribed',
        ]);
        $ip = $request->ip();
        $subscriber = Subscriber::create([
            'subscribe_email' => $request->subscribe_email,
            'subscribe_ip' => $ip,
        ]);
        if ($subscriber) {
            $notification = array(
                'message' => 'Thanks For Subscribe!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Subscribe Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    public function specialOffer(): Factory|View|Application
    {
        $products = Product::with('category')->where('product_active', 1)->where('product_status', 1)->where('product_hotDeal', 1)->paginate(18);
        // return $products;
        return view('frontend.pages.specialOffer', compact('products'));
    }

    public function contactUs(): Factory|View|Application
    {
        return view('frontend.pages.contact');
    }
    public function contactStore(Request $request): RedirectResponse
    {
        $request->validate([
            'user_name' => 'required',
            'user_email' => 'required|email',
            'user_phone' => 'required',
            'user_message' => 'required',
        ], [
            'user_name.required' => 'Please Enter Your Name',
            'user_email.required' => 'Please Enter Your Email Address',
            'user_phone.required' => 'Please Enter Your Phone',
            'user_message.required' => 'Please Enter Your Message',
        ]);
        $supportMessage = SupportMessage::create([
            'support_name' => $request->user_name,
            'support_email' => $request->user_email,
            'support_phone' => $request->user_phone,
            'support_message' => $request->user_message,
            'support_slug' => uniqid('support', true),
        ]);

        if ($supportMessage) {
            $notification = array(
                'message' => 'Thanks For Contact Us!',
                'alert-type' => 'success',
            ); // returns Notification,
        } else {
            $notification = array(
                'message' => 'Contact Failed!',
                'alert-type' => 'error',
            ); // returns Notification,
        }
        return redirect()->back()->with($notification);
    }

    // BLOG FUNCTION
    public function allBlog(): Factory|View|Application
    {
        $blogCategories = BlogCategory::where('bc_active', 1)->where('bc_status', 1)->limit(5)->latest()->get();
        $posts = Post::where('post_active', 1)->where('post_status', 1)->latest()->paginate(5);
        return view('frontend.pages.blog.index', compact('posts', 'blogCategories'));
    }
    public function categoryBlog(): Factory|View|Application
    {
        $category = BlogCategory::where('bc_active', 1)->where('bc_status', 1)->firstOrFail();
        $posts = Post::where('post_active', 1)->where('post_status', 1)->where('bc_id', $category->bc_id)->latest()->paginate(5);
        $blogCategories = BlogCategory::where('bc_active', 1)->where('bc_status', 1)->limit(5)->latest()->get();
        return view('frontend.pages.blog.index', compact('posts', 'blogCategories'));
    }

    public function singleBlog($url): Factory|View|Application
    {
        $post = Post::where('post_active', 1)->where('post_status', 1)->where('post_url', $url)->firstOrFail();
        $blogCategories = BlogCategory::where('bc_active', 1)->where('bc_status', 1)->limit(5)->latest()->get();
        return view('frontend.pages.blog.show', compact('post', 'blogCategories'));
    }

    public function brandProducts($url): Factory|View|Application
    {
        $brand = Brand::where('brand_url', $url)->firstOrFail();
        $products = Product::where('product_active', 1)->where('product_status', 1)->where('id', $brand->id)->paginate(10);
        return view('frontend.pages.brand.brandProducts', compact('products', 'brand'));
    }

    public function tagProducts($slug): Factory|View|Application
    {
        $tag = Tag::where('tag_slug', $slug)->firstOrFail();
        $products = Product::where('product_active', 1)->where('product_status', 1)->where('product_tag', $tag->id)->paginate(10);
        return view('frontend.pages.tag.index', compact('tag', 'products'));
    }
}

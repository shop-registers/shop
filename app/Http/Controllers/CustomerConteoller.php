<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CustomerConteoller extends Controller{
    //评论列表
    public function customerlist()
    {
        $data = Comment::where('userid','<>',0)
            ->orderBy('comment.id','desc')
            ->leftJoin('goods','objectid','=','goods.id')
            ->select('comment.id','addtime','username','good_name')
            ->paginate(15);
        return view('customer.customerlist',['data'=>$data]);
    }

    //评论详情
    public function comment(Request $request,$id=null)
    {
        $data = Comment::where('comment.id',$id)
            ->leftJoin('goods','objectid','=','goods.id')
            ->select('comment.id','objectid','addtime','username','good_name','content')
            ->first();
        return view('customer.comment',['data'=>$data]);
    }

    //回复评论
    public function commentadd(Request $request)
    {
        $data = $request->input();
        unset($data['_token']);
        $data['addtime'] = date('Y-m-d');

        if(Comment::create($data)){
            return 1;
        }else{
            return 2;
        }
    }

    //评论删除
    public function commentdelete(Request $request,$id=null)
    {
        self::del($id);
        return redirect('customerlist');
    }

    public static function del($id)
    {
        $comment = Comment::find($id);
        if(!$comment){
            return false;
        }
        $commentOne = Comment::where('parentid',$id)->get();
        if(count($commentOne) != 0){
            $comment->delete();
            foreach($commentOne as $item){
                self::del($item->id);
            }
            return true;
        }else{
            $comment->delete();
            return true;
        }
    }
}
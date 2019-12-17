<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Digest;
/**
 * 文章列表api控制器
 * @author zhangxiaobin <zxbin.1990@gmail.com>
 * @date 2019-12-16 12:51
 */
class DigestController extends Controller
{
	/**
	 * [digestList description]
	 * @param  [type] $book_id [description]
	 * @return [type]          [description]
	 */
    public function digestList($book_id)
    {
      return view('books.digest')->with('book_id', $book_id);
    }

    /**
     * 获取信息
     * @param string $value [description]
     */
    public function digests($book_id)
    {
    	$posts = Digest::where('book_id', '=', $book_id)->where('status',1)->orderBy('created_at', 'desc')->select('*')->get();
    	return $posts;
    }

    /**
     * 删除
     * @param  [type] $id [description]
     * @return [type]     [description]
    */
    public function delete($id)
    {
        // $f = Digest::destroy([$id]);
        $post = Digest::find($id);
        $post->status = 2;
        $post->save();
        return 1;
    }
}

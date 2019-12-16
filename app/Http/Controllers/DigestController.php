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
    	// $posts = Digest::where('book_id', '=', $book_id)->select('*')->get();
      return view('books.digest')->with('book_id', $book_id);
    }

    /**
     * [FunctionName description]
     * @param string $value [description]
     */
    public function digests($book_id)
    {
    	$posts = Digest::where('book_id', '=', $book_id)->select('*')->get();
    	return $posts;
    }

    public function delete($id)
    {
        $f = Digest::destroy([$id]);
        return $f;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
        $results =  Digest::latest()
        ->where('book_id',$book_id)
        ->where('status',1)
        ->orderBy('created_at', 'desc')
        ->paginate(7);
        $response = [
            'pagination' => [
                'total' => $results->total(),
                'per_page' => $results->perPage(),
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem()
            ],
            'data' => $results
        ];
        
        return $response; 
    }

    /**
     * 获取单个笔记信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function digestInfo($id)
    {
      // $post = Digest::find($id);
      $info = DB::table('digest')
      ->join('book', 'digest.book_id', '=', 'book.id')
      ->select('digest.*', 'book.name')
      ->where('digest.id',$id)
      ->get();
      return $info;
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

    /**
     * 编辑
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function digestEdit($id = 0)
    {
        return view('books.digestoperate')->with('digest_id', $id);
    }

    /**
     * 进行更新操作
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function digestSave(Request $request)
    {
      $this->validate($request, [
         'content'   => 'required',
         'bookid'   => 'required|numeric'
      ], [
         'content.required'=> '书名不能为空',
         'bookid.required'   => '书目不能为空',
         'bookid.numeric'    => '书目必须是数字',
      ]);
      $digest_id = $request->input('digest_id',0);
      $book_id = $request->input('bookid');
      $content = $request->input('content');
      if ($digest_id == 0) {
          // add
          $res = Digest::firstOrCreate([
              'content'   => $content,
              'book_id' => $book_id
          ]);
      } else {
          $post = Digest::find($digest_id);
          $post->content = $content;
          $post->book_id = $book_id;
          $res = $post->save();
      }
      return response(1);   
    }
}

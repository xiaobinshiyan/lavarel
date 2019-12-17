<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
/**
 * 读书笔记api控制器
 * @author zhangxiaobin <zxbin.1990@gmail.com>
 * @date 2019-12-16 09:51
 */
class BookController extends Controller
{
	/**
	 * API获取读书列表
	 * @return [type] [description]
	 */
    public function bookList()
    {
        // $list = Book::all();
        $list = Book::where('status', 1)
               ->orderBy('sort', 'asc')
               ->get();
        if (! empty($list)) {
            foreach ($list as $k => $v) {
                $digests = Book::findOrFail($v['id']);
                $v['num'] = count($digests->digest);
                $v['href'] = '/digest/' . $v['id'];
            }
        }
        return $list;
    }

    /**
     * 获取书本信息
     * @param  int $id 书本主键
     * @return object     书本信息
     */
    public function bookInfo($id)
    {
        $info = Book::findOrFail($id);
        return $info;
    }

    /**
     * 点击量添加
     * @param  int $id 书本主键
     * @return object
     */
    public function click($id) 
    {
        $res = Book::where('id', '=', $id)->increment('clicks');
        return $res;
    }

    /**
     * 添加书本
     * @param string $value [description]
     */
    public function bookAdd($id = 0)
    { 
        return view('books.bookadd')->with('book_id', $id);        
    }

    public function bookSave(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|max:45',
           'author' => 'required|max:45',
           'sort' => 'required|numeric'
        ], [
           'name.required' => '书名不能为空',
           'author.required' => '作者不能为空',
           'sort.required' => '排序不能为空',
           'sort.numeric' => '排序必须是数字',
        ]);
        $book_id = $request->input('book_id');
        $name = $request->input('name');
        $author = $request->input('author');
        $sort = $request->input('sort');
        if ($book_id == 0) {
            // add
            $res = Book::firstOrCreate([
                'name' => $name,
                'author' => $author,
                'sort' => $sort
            ]);
        } else {
            $post = Book::find($book_id);
            $post->name = $name;
            $post->author = $author;
            $post->sort = $sort;
            $res = $post->save();
        }
        return response(1);               
    }
}

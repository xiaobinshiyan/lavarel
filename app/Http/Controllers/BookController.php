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
               ->orderBy('clicks', 'desc')
               ->get();
        if (! empty($list)) {
            foreach ($list as $k => $v) {
                $digests = Book::findOrFail($v['id']);
                $v['num'] = count($digests->digest);
                $v['href'] = '/digest/' . $v['id'];
            }
        }
   			// echo "<pre>";print_r($list);exit();
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
}

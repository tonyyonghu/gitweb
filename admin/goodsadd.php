<?php
define('ACC','admin');
require('../includes/init.php');

/*
商品发布的表单页面
步骤:
1:实例化cateModel
2:调用cateModel的cateList方法,获取排序后的栏目.
3:把栏目信息循环展示出来
*/


$cateModel = new cateModel();
$list = $cateModel->cateList();

// print_r($list);exit




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加新商品 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function charea(a) {
    var spans = ['general','detail','mix'];
    for(i=0;i<3;i++) {
        var o = document.getElementById(spans[i]+'-tab');
        var tb = document.getElementById(spans[i]+'-table');
        o.className = o.id==a+'-tab'?'tab-front':'tab-back';
        tb.style.display = tb.id==a+'-table'?'block':'none';
    }
    
}
</script>
</head>
<body>

<h1>
<span class="action-span"><a href="goods.php?act=list">商品列表</a></span>
<span class="action-span1"><a href="index.php?act=main">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加新商品 </span>
<div style="clear:both"></div>
</h1>

<!-- start goods form -->
<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
      <p>
        <span class="tab-front" id="general-tab" onclick="charea('general');">通用信息</span>
        <span class="tab-back" id="detail-tab" onclick="charea('detail');">详细描述</span>
        <span class="tab-back" id="mix-tab" onclick="charea('mix');">其他信息</span>

      </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
      <form enctype="multipart/form-data" action="goodsadd_ok.php" method="post" name="theForm" >
        <!-- 最大文件限制 -->
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
        <!-- 通用信息 -->
        <table width="90%" id="general-table" align="center">
          <tr>
            <td class="label">商品名称：</td>
            <td><input type="text" name="goods_name" value="" style="float:left;color:;" size="30" /></td>
          </tr>
          <tr>
            <td class="label">
            <a href="#" title="点击此处查看提示信息"><img src="images/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商品货号： </td>
            <td><input type="text" name="goods_sn" value="" size="20"  /><span id="goods_sn_notice"></span><br />
            <span class="notice-span" style="display:block"  id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
          </tr>
          <tr>
            <td class="label">商品分类：</td>
            <td><select name="cat_id"  >
                    <option value="0">请选择...</option>
                    <?php foreach($list as $v) { ?>
                    <option value="<?php echo $v['cat_id']; ?>"><?php echo str_repeat('&nbsp;',2*$v['lev']); ?><?php echo $v['cat_name']; ?></option>
                    <?php } ?>
                </select>
             </td>
          </tr>
                   <tr>
            <td class="label">本店售价：</td>
            <td><input type="text" name="shop_price" value="0" size="20" /></td>
          </tr>
                   <tr>
            <td class="label">市场售价：</td>
            <td><input type="text" name="market_price" value="0" size="20" /></td>
          </tr>
          
          <tr>
            <td class="label">上传商品图片：</td>
            <td>
              <input type="file" name="ori_img" size="35" />
            </td>
          </tr>
        </table>

        <!-- 详细描述 -->
        <table width="90%" id="detail-table" style="display:none">
          <tr>
            <td><textarea name="goods_desc"></textarea></td>
          </tr>
        </table>

        <!-- 其他信息 -->
        <table width="90%" id="mix-table" style="display:none" align="center">
                    <tr>
            <td class="label">商品重量：</td>
            <td><input type="text" name="goods_weight" value="" size="20" /> <select name="weight_unit"><option value="1" selected>千克</option><option value="0.001">克</option></select></td>
          </tr>
          <tr>
            <td class="label"><a href="#" title="点击此处查看提示信息"><img src="images/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商品库存数量：</td>

            <td><input type="text" name="goods_number" value="1" size="20" />
          </tr>
                    <tr>
            <td class="label">加入推荐：</td>
            <td><input type="checkbox" name="is_best" value="1"  />精品 <input type="checkbox" name="is_new" value="1"  />新品 <input type="checkbox" name="is_hot" value="1"  />热销</td>
          </tr>
          <tr id="alone_sale_1">
            <td class="label" id="alone_sale_2">上架：</td>
            <td id="alone_sale_3"><input type="checkbox" name="is_on_sale" value="1" checked="checked" /> 打勾表示允许销售，否则不允许销售。</td>
          </tr>
          <tr>
            <td class="label">商品关键词：</td>
            <td><input type="text" name="keywords" value="" size="40" /> 用空格分隔</td>
          </tr>
          <tr>
            <td class="label">商品简单描述：</td>
            <td><textarea name="goods_brief" cols="40" rows="3"></textarea></td>
          </tr>
        </table>

  
        <div class="button-div">
          <input type="hidden" name="goods_id" value="0" />
                    <input type="submit" value=" 确定 " class="button" />
          <input type="reset" value=" 重置 " class="button" />
        </div>
        <input type="hidden" name="act" value="insert" />
      </form>
    </div>
</div>
<!-- end goods form -->

</body>
</html>
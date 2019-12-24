<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>测试板</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="../../layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="../../layuiadmin/style/admin.css" media="all">
  <link rel="stylesheet" href="../../layuiadmin/style/template.css" media="all">
</head>
<body>


<div class="layui-fluid layadmin-message-fluid">
  <div class="layui-row">
    <div class="layui-col-md12">
      <div class="layui-card">
        <div class="layui-card-head">
          <form class="layui-form">
            <div class="layui-form-item layui-form-text">
              <div class="layui-input-block">
                <textarea id="content" name="desc" placeholder="请输入内容" class="layui-textarea" onkeyup="textareainput()"></textarea>
              </div>
            </div>
          </form>
        </div>
        <div class="layui-card-body">
          <table id="test_result" class="layui-table">
            <thead>
              <tr>
                <th>主体分类</th>
                <th>主体名</th>
                <th>关键词</th>
                <th>语义分类</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


  <script src="../../layuiadmin/layui/layui.js"></script>  
  <script src="../../jquery/jquery-3.4.1.min.js"></script>  
  <script>
  layui.config({
    base: '../../layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index']);
  layui.use(['layer','form'],function(){
    var form = layui.form;
    form.on('submit(formDemo)', function(data){
      // layer.msg(JSON.stringify(data.field));
      return false;
    });
  })

  function textareainput () {
      var content = document.getElementById("content").value;
      var tbody = $('#test_result').children('tbody');
      $.ajax({
        url: '/ajax_test',
        method:'post',
        data: {
          content: content,
        },
        dataType:'JSON',
        success:function (res) {
          if (res.code == '0') {
              tbody.find('tr').remove();
              for(i = 0; i < res.data.length; i++) {
                  var obj = res.data[i];
                  tbody.append($('<tr> <td>'+ obj.subject_category +'</td> <td>'+ obj.subject +'</td> <td>'+ obj.keyword +'</td> <td>'+ obj.category +'</td> </tr>'))
              }
          } else {
              console.log(res.msg);
          }
        }
      });
  }
  </script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>群机器人</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layuiadmin/style/admin.css" media="all">
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">群机器人</div>
          <div class="layui-card-body">
            <table class="layui-hide" id="robot-table" lay-filter="robot-table"></table>

            <script type="text/html" id="robot-table-toolbar">
              <div class="layui-btn-container">
                <button class="layui-btn layui-btn-sm" lay-event="add">添加群机器人</button>
              </div>
            </script>

            <script type="text/html" id="robot-table-bar">
              <a class="layui-btn layui-btn-xs" lay-event="update">修改</a>
              <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="/layuiadmin/layui/layui.js"></script>  
  <script>
  layui.config({
      base: '/layuiadmin/'
  }).extend({
    index: 'lib/index'
  }).use(['index', 'table'], function() {
    var admin = layui.admin
    ,table = layui.table;
  
    table.render({
       elem: '#robot-table'
      ,url: '/robots/ajax'
      ,toolbar: '#robot-table-toolbar'
      ,height: 'full-100'
      ,cellMinWidth: 80
      ,page: false
      ,cols: [[{"field":"id","title":"ID","sort":true},{"field":"name","title":"名称","sort":true,"align":"center"},{"field":"description","title":"描述","sort":true,"align":"center"},{"field":"webhook_url","title":"Webhook地址","sort":true,"align":"center"},{"field":"application_display","title":"应用","sort":true},{"field":"create_time","title":"添加时间","sort":true},{"field":"update_time","title":"修改时间","sort":true},{"fixed":"right","title":"操作","toolbar":"#robot-table-bar","width":150}]]
    });

    table.on('toolbar(robot-table)', function(obj) {
      switch (obj.event) {
        case 'add':
            window.location.href = '/robots/add';
        break;
      };
    });

    table.on('tool(robot-table)', function(obj) {
      var data = obj.data;
      if (obj.event === 'del') {
          layer.confirm('确定删除群机器人['+data.id+']么', function(i) {
              layui.jquery.post('/robots/delete/'+data.id, null, function (res) {
                  if (res.code) {
                      layer.close(i);
                      layer.msg(res.msg);
                  } else {
                      table.reload('robot-table');
                      layer.close(i);
                  }
              }, 'json');
        });
      } else if (obj.event === 'update') {
          window.location.href = '/robots/update/'+data.id;
      }
    });
    
  });
  </script>
</body>
</html>

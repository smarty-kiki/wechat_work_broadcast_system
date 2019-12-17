<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{ $entity_info['display_name'] }}[^^{^^{ ${{ $entity_name }}->id ^^}^^}]修改</title>
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
          <div class="layui-card-header"></div>
          <div class="layui-card-body">
            <form class="layui-form" action="" method="POST" lay-filter="component-form-element">
@foreach ($relationship_infos['relationships'] as $attribute_name => $relationship)
@if ($relationship['relationship_type'] === 'belongs_to')
              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                  <label class="layui-form-label">{{ $relationship['entity_display_name'] }}：</label>
                  <div class="layui-input-block">
                    <select name="{{ $attribute_name }}_id" lay-verify="required" lay-filter="aihao" lay-search>
@if ($relationship['association_type'] === 'aggregation')
                        <option value='0'>无</option>
@endif
@^^foreach (${{ english_word_pluralize($attribute_name) }} as $id => ${{ $attribute_name }})
                        <option value='^^{^^{ $id ^^}^^}' ^^{^^{ '{{ $id }}' === ${{ $entity_name }}->{{ $attribute_name }}_id?'selected':'' ^^}^^}>^^{^^{ ${{ $attribute_name }}->display_for_{{ $relationship['self_attribute_name'] }}_{{ $attribute_name }}() ^^}^^}</option>
@^^endforeach
                    </select>
                  </div>
                </div>
              </div>
@endif
@endforeach
@foreach ($entity_info['structs'] as $struct_name => $struct)
              <div class="layui-row layui-col-space10 layui-form-item">
                <div class="layui-col-lg6">
                  <label class="layui-form-label">{{ $struct['display_name'] }}：</label>
                  <div class="layui-input-block">
                    {{ blade_eval(_generate_template_data_type_update($struct['data_type']), ['entity_name' => $entity_name, 'struct_name' => $struct_name, 'struct' => $struct]) }}
                  </div>
                </div>
              </div>
@endforeach
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <a href='javascript:window.history.back(-1);' class="layui-btn layui-btn-danger">取消</a>
                  <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                  <button class="layui-btn" lay-submit lay-filter="component-form-element">立即修改</button>
                </div>
              </div>
            </form>
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
  }).use(['index', 'form'], function(){
    var $ = layui.$
    ,admin = layui.admin
    ,element = layui.element
    ,form = layui.form;
    
    form.render(null, 'component-form-element');
    element.render('breadcrumb', 'breadcrumb');
    
    form.on('submit(component-form-element)', function(data){
      return true;
    });
  });
  </script>
</body>
</html>

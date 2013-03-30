(function(){
    function toArray(obj){
        var array = [];
        if(obj.length>0){
            array.concat.apply(obj, array);
        }
        return array;
    }

    var re1  = /<[\/]?([-_a-z0-9]*)[^>]*>/ig;
    var re2 = /([-_a-z0-9]*)\s*=\s*"[^"]*"\s*/ig;
    var re3 = /(&nbsp;)+/ig;
    var re4 = /[\n\t]+/ig;

    var replace_func1 = function(a, b){
        b = (b+'').toLowerCase();
        if(b=='img' || b=='p'){
            return a;
        }else{
            return '';
        }
    };

    var replace_func2 = function(a, b){
        b = (b+'').toLowerCase();
        if(b=='src'){
            return a;
        }else{
            return '';
        }
    };

    var onekeyformat = {};
    onekeyformat.commands = {
        oneKeyFormat : {
                           async: true,
                           exec : function( editor ) {
                                      var body = editor.document.$.body;
                                      var nodes = [].concat(toArray(body.getElementsByTagName('script')),
                                              toArray(body.getElementsByTagName('style')),
                                              toArray(body.getElementsByTagName('textarea')));
                                      for(var i=0, l=nodes.length; i<l; i++){
                                          var node = nodes[i];
                                          if(node && node.parentNode){
                                              node.parentNode.removeChild(node);
                                          }
                                      }
                                      var content = editor.getData();
                                      content = content.replace(re1, replace_func1).replace(re2, replace_func2)
                                          .replace(re3, '$1').replace(re4, '');
                                      //console.info(content);
                                      body.innerHTML = content;
                                  }
                       }
    };
    onekeyformat.lang = ['zh-cn'];
    onekeyformat.init = function( editor ) {
        editor.addCommand( 'oneKeyFormat', this.commands.oneKeyFormat);
        editor.ui.addButton('OneKeyFormat', {
            command : 'oneKeyFormat',
            label : editor.lang.onekeyformat.title,
            icon: this.path+'icon.gif'
        });
    };

    CKEDITOR.plugins.add( 'onekeyformat', onekeyformat);

})();

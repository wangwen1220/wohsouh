(function(){
    var Class = function () {};
    Class.extend = function (def) {
        var defClass = function () {
            if (arguments[0] !== Class) {
                if(typeof this.__init__ === 'function'){
                    this.__init__.apply(this, arguments);
                }
            }
        };
        defClass.prototype = new this(Class);
        for(var key in def){
            defClass.prototype[key] = def[key];
        }
        defClass.prototype.__super__ = this.prototype;
        defClass.extend = arguments.callee;
        return defClass;
    };


    //var HUI = this.HUI = {};
})();

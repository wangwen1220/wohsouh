var _regexp={email:/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/,any:/(.*)/,identity:/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/,url:/http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/,username:/^[a-z]\w{3,19}$/i,password:/^[^\s\$]{6,20}$/,telephone:/^(86)?(\d{3,4}-)?(\d{7,8})$/,mobile:/^1\d{10}$/,ip:/^((2[0-4]\d|25[0-5]|[01]?\d\d?)\.){3}(2[0-4]\d|25[0-5]|[01]?\d\d?)$/,id:/^(?:\d{14}|\d{17})[\dxX]$/,qq:/^[1-9]\d{4,20}$/,date:/^(\d{4})(-|\/)(\d{1,2})\2(\d{1,2})$/,datetime:/^(\d{4})(-|\/)(\d{1,2})\2(\d{1,2})\s(\d{1,2}):(\d{1,2}):(\d{1,2})$/,
zipcode:/^[0-9]\d{5}$/,currency:/^\d+(\.\d+)?$/,number:/^\d+$/,english:/^[A-Za-z]+$/,chinese:/^[\u4e00-\u9fa5]+$/,integer:/^[-\+]?\d+$/,"float":/^[-\+]?\d+(\.\d+)?$/};
$(function(){$("#signform").submit(function(){if(!validate(_regexp.any,$("#name"),50))return false;if(!validate(_regexp.any,$("#man")))return false;if(!validate(_regexp.any,$("#photo")))return false;if(!validate(_regexp.email,$("#email")))return false;if(!validate(_regexp.any,$("#address"),100))return false;if(!validate(_regexp.telephone,$("#telephone")))return false;if(!validate(_regexp.mobile,$("#mobile")))return false;if(!validate(_regexp.zipcode,$("#zipcode")))return false;if(!validate(_regexp.qq,
$("#qq")))return false;if(!validate(_regexp.email,$("#msn")))return false;if(!validate(_regexp.url,$("#site")))return false;if(!validate(_regexp.any,$("#job"),50))return false;if(!validate(_regexp.identity,$("#identity")))return false;if(!validate(_regexp.any,$("#company"),100))return false;if(!validate(_regexp.any,$("#aid")))return false;if(!validate(_regexp.any,$("#note")))return false})});
function validate(e,a,c){if(typeof a[0]=="undefined")return true;var d=a.parent(),b=d.prev().find("label").html();if(a.is(":radio")&&d.children("input:radio:checked")[0]==undefined){alert(b+"\u5fc5\u586b");a.focus();return false}if(a.val()==""&&d.hasClass("need")){alert(b+"\u4e0d\u5f97\u4e3a\u7a7a");a.focus();return false}if(c)if(a.val().length>c){alert(b+"\u4e0d\u5f97\u8d85\u8fc7"+c+"\u4e2a\u5b57\u7b26");a.focus();return false}if(a.val())if(!e.test(a.val())){alert(b+"\u683c\u5f0f\u4e0d\u6b63\u786e");
a.focus();return false}return true};

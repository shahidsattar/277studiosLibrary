String.prototype.normalize_charset=function(){return this.toLowerCase().replace(/[_,.-]/,"")};function check_for_encoding_change(c,e){var b=e[0].charset;if(b.normalize_charset()!==CHARSET.normalize_charset()){var d=YAHOO.lang.substitute(c,{old_charset:CHARSET.toUpperCase(),new_charset:b.toUpperCase()});var a=new CPANEL.ajax.Common_Dialog("enc_changed",{width:"500px",show_status:true,status_html:LEXICON.reloading});a.cfg.getProperty("buttons")[0].text=LOCALE.maketext("OK");a.cfg.getProperty("buttons").pop();DOM.addClass(a.element,"cjt_notice_dialog cjt_info_dialog");a.setHeader("<div class='lt'></div><span>"+LEXICON.charset_changed+"</span><div class='rt'></div>");a.renderEvent.subscribe(function(){this.form.innerHTML=d;this.center()});a.submitEvent.subscribe(function(){var f=location.href.replace(/([^&?]*charset)=[^&]*/g,"$1="+b);location.href=f});this.fade_to(a)[0].onComplete.subscribe(this.hide,this,true);return false}}function confirm_close(b){var c=window.CODEWINDOW?CODEWINDOW.value!==CODEWINDOW.defaultValue:wp_current_obj.getSubmitValue()!==LAST_SAVED_VALUE;if(c){var a=new CPANEL.ajax.Common_Dialog();a.setBody(LEXICON.confirm_close);a.submit=function(){window.close()};a.beforeShowEvent.subscribe(a.center,a,true);a.show(b)}else{window.close()}};
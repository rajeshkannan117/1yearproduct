function get_local_date_js(date1,id)
 {
	     var id = id;
       if (!Date.prototype.toUTCISOString) {

           Date.prototype.toUTCISOString = function() {
             function addZ(n) {
               return (n<10? '0' : '') + n;
             }
             function addZ2(n) {
               return (n<10? '00' : n<100? '0' : '') + n;
             }
             return this.getUTCFullYear() + '-' +
                    addZ(this.getUTCMonth() + 1) + '-' +
                    addZ(this.getUTCDate()) + 'T' +
                    addZ(this.getUTCHours()) + ':' +
                    addZ(this.getUTCMinutes()) + ':' +
                    addZ(this.getUTCSeconds()) + '.' +
                    addZ2(this.getUTCMilliseconds()) + 'Z';
           }
       }


       if (!Date.parseUTCISOString) {
          Number.prototype.padLeft = function(base,chr){
   var  len = (String(base || 10).length - String(this).length)+1;
   return len > 0? new Array(len).join(chr || '0')+this : this;
 }

           Date.parseUTCISOString = function fromUTCISOString(s) {
               var b = s.split(/[-\s:\s]/i);//
               var n= new Date(Date.UTC(b[0],b[1]-1,b[2],b[3],b[4],b[5]));
               hours = n.getHours().padLeft();
               var ampm = hours >= 12 ? 'pm' : 'am';
               hours = hours % 12;
               hours = hours ? hours : 12; // the hour '0' should be '12'  
               dates = [ n.getFullYear(),
                    (n.getMonth()+1).padLeft(),
                    n.getDate().padLeft(),
                    ].join('-')+
                    ' ' +
                  [ hours,
                    n.getMinutes().padLeft(),
                    n.getSeconds().padLeft()].join(':');
               //console.log(dates + ' '+ampm);
               return dates+ ' '+ampm;
           }
       }

        var s = date1;
        var dates = Date.parseUTCISOString(s);
        //console.log(dates);
      
	/*var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
	var monthNames_caps = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC" ];
	var date_change = new Date(dates); 
	var day = date_change.getDate();
	var monthIndex = date_change.getMonth();
	var year = date_change.getFullYear();
	var month_name = monthNames[monthIndex];
	var hour = date_change.getHours();
	
	var hours = date_change.getHours();
	hour = hour % 12;
  	hour = hour ? hour : 12; 

	var minutes_date = (date_change.getMinutes()<10?'0':'') + date_change.getMinutes();
	if(type == 'log')
	{
	 var month_names = monthNames_caps[monthIndex];
	 res = month_names+' '+day+', '+year;
         document.write(res);
	}
        if(type != 'log' && type != 'common' && type != 'edit_id_based' && type != 'log_deadline')
	{
        
	 var month_names = monthNames_caps[monthIndex];
	 res = month_names+' '+day+', '+year+'  ' + hour + ':' +  minutes_date + ' ' + (hours > 11 ? 'PM' : 'AM');
         document.write(res);
	}
        if(type == 'common')
	{
	
         /*var res = e.split(",");
	 var month = res[0].charAt(0).toUpperCase() + res[0].slice(1).toLowerCase();
	 res = month+','+res[1]+' - '+res[2]; // default

	 res = month_name+' '+day+', '+year+' - ' + hour + ':' +  minutes_date + ' ' + (hours > 11 ? 'PM' : 'AM');
         document.write(res);
	}
	if(type == 'edit_id_based')
	{
	
	res = month_name+' '+day+', '+year+' - ' + hour + ':' +  minutes_date + ' ' + (hours > 11 ? 'PM' : 'AM');
	document.getElementById(id).innerHTML=res;
	}
	if(type == 'log_deadline')
	{
	
	 var date_change = new Date(dates); 
	 var day = date_change.getDate();
	 var monthIndex = date_change.getMonth()+1;
	 var year = date_change.getFullYear();
	
	 if ( monthIndex < 10 )
            var string_mon = '0'+monthIndex;
         else
            var string_mon = monthIndex;
	
	 if ( day < 10 )
            var string_date = '0'+day;
         else
            var string_date = day;

	 var newDate = string_mon + '/' + string_date + '/' + year;*/
   //console.log(id);
	 document.getElementById(id).innerHTML=dates;
	//}
	
   }
/*function get_local_date_js_readby_users(date1,id)
 {
	
       if (!Date.prototype.toUTCISOString) {

           Date.prototype.toUTCISOString = function() {
             function addZ(n) {
               return (n<10? '0' : '') + n;
             }
             function addZ2(n) {
               return (n<10? '00' : n<100? '0' : '') + n;
             }
             return this.getUTCFullYear() + '-' +
                    addZ(this.getUTCMonth() + 1) + '-' +
                    addZ(this.getUTCDate()) + 'T' +
                    addZ(this.getUTCHours()) + ':' +
                    addZ(this.getUTCMinutes()) + ':' +
                    addZ(this.getUTCSeconds()) + '.' +
                    addZ2(this.getUTCMilliseconds()) + 'Z';
           }
       }


       if (!Date.parseUTCISOString) {

           Date.parseUTCISOString = function fromUTCISOString(s) {
               var b = s.split(/[-\s:\s]/i);
               var n= new Date(Date.UTC(b[0],b[1]-1,b[2],b[3],b[4],b[5]));
               return n;
           }
       }

        var s = date1;
        var dates = Date.parseUTCISOString(s);

       //alert(dates);
	var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
	var monthNames_caps = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC" ];
	var date_change = new Date(dates); 
	var day = date_change.getDate();
	var monthIndex = date_change.getMonth()+1;
	var year = date_change.getFullYear();
	var month_name = monthNames[monthIndex];
	var hour = date_change.getHours();
	
	var hours = date_change.getHours();
	hour = hour % 12;
  	hour = hour ? hour : 12; 

	var minutes_date = (date_change.getMinutes()<10?'0':'') + date_change.getMinutes();
	
	 //var month_names = monthNames_caps[monthIndex];

         if ( monthIndex < 10 )
            var string_mon = '0'+monthIndex;
         else
            var string_mon = monthIndex;
	
	 if ( day < 10 )
            var string_date = '0'+day;
         else
            var string_date = day;

	 var res = string_mon+'-'+string_date+'-'+year+'  ' + hour + ':' +  minutes_date + ' ' + (hours > 11 ? 'PM' : 'AM');
        
        document.getElementById(id).innerHTML=res;
	
        
	
	
	
   }
function get_local_date_js_add(date1,id)
 {
	
       if (!Date.prototype.toUTCISOString) {

           Date.prototype.toUTCISOString = function() {
             function addZ(n) {
               return (n<10? '0' : '') + n;
             }
             function addZ2(n) {
               return (n<10? '00' : n<100? '0' : '') + n;
             }
             return this.getUTCFullYear() + '-' +
                    addZ(this.getUTCMonth() + 1) + '-' +
                    addZ(this.getUTCDate()) + 'T' +
                    addZ(this.getUTCHours()) + ':' +
                    addZ(this.getUTCMinutes()) + ':' +
                    addZ(this.getUTCSeconds()) + '.' +
                    addZ2(this.getUTCMilliseconds()) + 'Z';
           }
       }


       if (!Date.parseUTCISOString) {

           Date.parseUTCISOString = function fromUTCISOString(s) {
               var b = s.split(/[-\s:\s]/i);
               var n= new Date(Date.UTC(b[0],b[1]-1,b[2],b[3],b[4],b[5]));
               return n;
           }
       }

         var dates = Date.parseUTCISOString(date1);

	 var date_change = new Date(dates); 
	 var day = date_change.getDate();
	 var monthIndex = date_change.getMonth()+1;
	 var year = date_change.getFullYear();
	
	 if ( monthIndex < 10 )
            var string_mon = '0'+monthIndex;
         else
            var string_mon = monthIndex;
	
	 if ( day < 10 )
            var string_date = '0'+day;
         else
            var string_date = day;

	 var newDate = string_mon + '-' + string_date + '-' + year;
	 document.getElementById(id).innerHTML=newDate;
	
   }
function get_local_js(date1)
 {
	
       if (!Date.prototype.toUTCISOString) {

           Date.prototype.toUTCISOString = function() {
             function addZ(n) {
               return (n<10? '0' : '') + n;
             }
             function addZ2(n) {
               return (n<10? '00' : n<100? '0' : '') + n;
             }
             return this.getUTCFullYear() + '-' +
                    addZ(this.getUTCMonth() + 1) + '-' +
                    addZ(this.getUTCDate()) + 'T' +
                    addZ(this.getUTCHours()) + ':' +
                    addZ(this.getUTCMinutes()) + ':' +
                    addZ(this.getUTCSeconds()) + '.' +
                    addZ2(this.getUTCMilliseconds()) + 'Z';
           }
       }


       if (!Date.parseUTCISOString) {

           Date.parseUTCISOString = function fromUTCISOString(s) {
               var b = s.split(/[-\s:\s]/i);
               var n= new Date(Date.UTC(b[0],b[1]-1,b[2],b[3],b[4],b[5]));
               return n;
           }
       }

         var dates = Date.parseUTCISOString(date1);
	
	 var date_change = new Date(dates); 
	 var day = date_change.getDate();
	 var monthIndex = date_change.getMonth()+1;
	 var year = date_change.getFullYear();
	
	 if ( monthIndex < 10 )
            var string_mon = '0'+monthIndex;
         else
            var string_mon = monthIndex;
	
	 if ( day < 10 )
            var string_date = '0'+day;
         else
            var string_date = day;

	 var newDate = year + '-' + string_mon + '-' + string_date;

	 document.write(newDate);
	
   }
function get_emoji_js_controller(val,id)
 {
	
         var testing = twemoji.parse(val);
	//console.log(testing);
	//return testing;
	 document.getElementById(id).innerHTML = testing;
	
   }
function get_emoji_js(val)
 {
	
         var testing = twemoji.parse(val);
	 document.write(testing);
	
   }*/

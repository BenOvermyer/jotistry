/*! jquery-dateFormat 18-05-2015 */
var DateFormat={};!function(a){var b=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],c=["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],d=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],e=["January","February","March","April","May","June","July","August","September","October","November","December"],f={Jan:"01",Feb:"02",Mar:"03",Apr:"04",May:"05",Jun:"06",Jul:"07",Aug:"08",Sep:"09",Oct:"10",Nov:"11",Dec:"12"},g=/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.?\d{0,3}[Z\-+]?(\d{2}:?\d{2})?/;a.format=function(){function a(a){return b[parseInt(a,10)]||a}function h(a){return c[parseInt(a,10)]||a}function i(a){var b=parseInt(a,10)-1;return d[b]||a}function j(a){var b=parseInt(a,10)-1;return e[b]||a}function k(a){return f[a]||a}function l(a){var b,c,d,e,f,g=a,h="";return-1!==g.indexOf(".")&&(e=g.split("."),g=e[0],h=e[e.length-1]),f=g.split(":"),3===f.length?(b=f[0],c=f[1],d=f[2].replace(/\s.+/,"").replace(/[a-z]/gi,""),g=g.replace(/\s.+/,"").replace(/[a-z]/gi,""),{time:g,hour:b,minute:c,second:d,millis:h}):{time:"",hour:"",minute:"",second:"",millis:""}}function m(a,b){for(var c=b-String(a).length,d=0;c>d;d++)a="0"+a;return a}return{parseDate:function(a){var b,c,d={date:null,year:null,month:null,dayOfMonth:null,dayOfWeek:null,time:null};if("number"==typeof a)return this.parseDate(new Date(a));if("function"==typeof a.getFullYear)d.year=String(a.getFullYear()),d.month=String(a.getMonth()+1),d.dayOfMonth=String(a.getDate()),d.time=l(a.toTimeString()+"."+a.getMilliseconds());else if(-1!=a.search(g))b=a.split(/[T\+-]/),d.year=b[0],d.month=b[1],d.dayOfMonth=b[2],d.time=l(b[3].split(".")[0]);else switch(b=a.split(" "),6===b.length&&isNaN(b[5])&&(b[b.length]="()"),b.length){case 6:d.year=b[5],d.month=k(b[1]),d.dayOfMonth=b[2],d.time=l(b[3]);break;case 2:c=b[0].split("-"),d.year=c[0],d.month=c[1],d.dayOfMonth=c[2],d.time=l(b[1]);break;case 7:case 9:case 10:d.year=b[3],d.month=k(b[1]),d.dayOfMonth=b[2],d.time=l(b[4]);break;case 1:c=b[0].split(""),d.year=c[0]+c[1]+c[2]+c[3],d.month=c[5]+c[6],d.dayOfMonth=c[8]+c[9],d.time=l(c[13]+c[14]+c[15]+c[16]+c[17]+c[18]+c[19]+c[20]);break;default:return null}return d.date=d.time?new Date(d.year,d.month-1,d.dayOfMonth,d.time.hour,d.time.minute,d.time.second,d.time.millis):new Date(d.year,d.month-1,d.dayOfMonth),d.dayOfWeek=String(d.date.getDay()),d},date:function(b,c){try{var d=this.parseDate(b);if(null===d)return b;for(var e,f=d.year,g=d.month,k=d.dayOfMonth,l=d.dayOfWeek,n=d.time,o="",p="",q="",r=!1,s=0;s<c.length;s++){var t=c.charAt(s),u=c.charAt(s+1);if(r)"'"==t?(p+=""===o?"'":o,o="",r=!1):o+=t;else switch(o+=t,q="",o){case"ddd":p+=a(l),o="";break;case"dd":if("d"===u)break;p+=m(k,2),o="";break;case"d":if("d"===u)break;p+=parseInt(k,10),o="";break;case"D":k=1==k||21==k||31==k?parseInt(k,10)+"st":2==k||22==k?parseInt(k,10)+"nd":3==k||23==k?parseInt(k,10)+"rd":parseInt(k,10)+"th",p+=k,o="";break;case"MMMM":p+=j(g),o="";break;case"MMM":if("M"===u)break;p+=i(g),o="";break;case"MM":if("M"===u)break;p+=m(g,2),o="";break;case"M":if("M"===u)break;p+=parseInt(g,10),o="";break;case"y":case"yyy":if("y"===u)break;p+=o,o="";break;case"yy":if("y"===u)break;p+=String(f).slice(-2),o="";break;case"yyyy":p+=f,o="";break;case"HH":p+=m(n.hour,2),o="";break;case"H":if("H"===u)break;p+=parseInt(n.hour,10),o="";break;case"hh":e=0===parseInt(n.hour,10)?12:n.hour<13?n.hour:n.hour-12,p+=m(e,2),o="";break;case"h":if("h"===u)break;e=0===parseInt(n.hour,10)?12:n.hour<13?n.hour:n.hour-12,p+=parseInt(e,10),o="";break;case"mm":p+=m(n.minute,2),o="";break;case"m":if("m"===u)break;p+=n.minute,o="";break;case"ss":p+=m(n.second.substring(0,2),2),o="";break;case"s":if("s"===u)break;p+=n.second,o="";break;case"S":case"SS":if("S"===u)break;p+=o,o="";break;case"SSS":var v="000"+n.millis.substring(0,3);p+=v.substring(v.length-3),o="";break;case"a":p+=n.hour>=12?"PM":"AM",o="";break;case"p":p+=n.hour>=12?"p.m.":"a.m.",o="";break;case"E":p+=h(l),o="";break;case"'":o="",r=!0;break;default:p+=t,o=""}}return p+=q}catch(w){return console&&console.log&&console.log(w),b}},prettyDate:function(a){var b,c,d;return("string"==typeof a||"number"==typeof a)&&(b=new Date(a)),"object"==typeof a&&(b=new Date(a.toString())),c=((new Date).getTime()-b.getTime())/1e3,d=Math.floor(c/86400),isNaN(d)||0>d?void 0:60>c?"just now":120>c?"1 minute ago":3600>c?Math.floor(c/60)+" minutes ago":7200>c?"1 hour ago":86400>c?Math.floor(c/3600)+" hours ago":1===d?"Yesterday":7>d?d+" days ago":31>d?Math.ceil(d/7)+" weeks ago":d>=31?"more than 5 weeks ago":void 0},toBrowserTimeZone:function(a,b){return this.date(new Date(a),b||"MM/dd/yyyy HH:mm:ss")}}}()}(DateFormat),function(a){a.format=DateFormat.format}(jQuery);
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function () {
    $('div[contenteditable]').keydown(function(e) {
        if (e.keyCode === 13) {
            document.execCommand('insertHTML', false, '<br>');
            return false;
        }
    });

    $('.new-note').click(function () {
        $('.title').html('');
        $('.body').html('');
        $('.update-note').hide();
        $('.save-note').show();
        $('.active').removeClass('active');
        $('.title').focus();
    });

    $('.delete-note').click(function () {
        var noteId = $('.id').val();

        $.ajax({
            url: '/notes/' + noteId,
            method: 'DELETE'
        }).done(function(response) {
            $('.' + noteId).remove();
            $('.title').html('');
            $('.body').html('');
            $('.update-note').hide();
            $('.save-note').show();
            $('.active').removeClass('active');
            $('.title').focus();
        });
    });

    $('.cards').delegate('.card', 'click', function(){
        $('.active').removeClass('active');
        $(this).addClass('active');
        $('.save-note').hide();
        $('.update-note').show();
        $('.delete-note').show();
        $('.title').html($(this).children('h3').html());
        $('.body').html($(this).children('div').html());
        $('.id').val($(this).children('span').html());
    });

    $('.save-note').click(function() {
        var data = {
            'title': $('.title').html(),
            'body': $('.body').html()
        };

        $.post('/notes', data, function(response) {
            var noteDate = new Date(response.updated_at);
            noteDate = $.format.date(noteDate, 'MMM D, yyyy h:mm p');
            $('.cards').prepend('<div class="card ' + response.id + ' active"><h3>' + response.title + '</h3><h4>Last Updated: ' + noteDate + '</h4><div>' + response.body + '</div><span>' + response.id + '</span>');
            $('.save-note').hide();
            $('.update-note').show();
            $('.id').val(response.id);
        });
    });

    $('.update-note').click(function() {
        var data = {
            'title': $('.title').html(),
            'body': $('.body').html()
        };

        $.post('/notes/' + $('.id').val(), data, function(response) {
            $('.cards > .' + response.id).html('<h3>' + response.title + '</h3><div>' + response.body + '</div><span>' + response.id + '</span>');
        });
    });

});

$(document).ready(function() {
    $('.tasks').delegate( '.complete-task', 'click', function() {
        var id = $(this).siblings('span').html();

        var data = {
            'content': $(this).siblings('div').html(),
            'is_completed': 1
        };

        $.post( 'tasks/' + id, data, function( response ) {
            $('.' + id).remove();
        });
    });

    $('.new-task').click(function() {
        var data = {
            'content': $('.content').html(),
            'is_completed': 0
        };

        $.post( 'tasks', data, function( response ) {
            $('.tasks').append( '<div class="task ' + response.id + '"><div contenteditable>' + response.content + '</div><button class="save-task button"><i class="fa fa-save"> Save</i></button> <button class="complete-task button"><i class="fa fa-check"></i> Complete</button> <span>' + response.id + '</span>')
            $('.content').html('');
        });
    });

    $('.tasks').delegate( '.save-task', 'click', function() {
        var id = $(this).siblings('span').html();

        var data = {
            'content': $(this).siblings('div').html(),
            'is_completed': 0
        };

        $.post( 'tasks/' + id, data, function( response ) {
            $(this).hide();
        });
    });
});
//# sourceMappingURL=all.js.map

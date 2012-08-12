// If we're running AppleWebApp mode, modify all "rel=external" to "onclick=window.location.href" and preserve just one app window.
 if ( ("standalone" in window.navigator) && window.navigator.standalone ) {
   $("a[rel*=external]").live('click', function(){
     window.location.href=this.href;
     return false;
   });
 }
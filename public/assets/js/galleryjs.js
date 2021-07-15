Dropzone.options.addImages={
maxFilesize:8,
acceptedFiles:'image/*',
success:function(file,response){
if (file.status=='success') {
	handleDropZoneFileUpload.handleSuccess(response);
} else {
	handleDropZoneFileUpload.handleError(response);
}

}
};
var handleDropZoneFileUpload={
	handleError:function(response){
      console.log(response);
	},
    handleSuccess:function(response){
          var imageList=$('#gallery-images ul');
          var imageSrc=baseUrl+"/"+response.picpath;
          console.log(response);
          console.log(imageSrc);
    $(imageList).append('<li><a href="'+imageSrc+'" data-lightbox="gallery"><img src="'+imageSrc+'"></a></li>');

    }     
 
};
$(document).ready(function(){
  console.log('document is ready');
});
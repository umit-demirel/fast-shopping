/**
 * Created by remi on 18/01/15.
 */
(function(){


    function previewImage(file) {
        var galleryId = "gallery";

        var gallery = document.getElementById(galleryId);
        var imageType = /image.*/;

        if (!file.type.match(imageType)) {
            throw "Dosya Tipi Bir Resim Olmalıdır.";
			alert("Dosya Tipi Bir Resim Olmalıdır!");
        }

        var thumb = document.createElement("div");
        thumb.classList.add('thumbnail');

        var img = document.createElement("img");
        img.file = file;
        thumb.appendChild(img);
        gallery.appendChild(thumb);

        // Using FileReader to display the image content
        var reader = new FileReader();
        reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
        reader.readAsDataURL(file);
    }

    var uploadfiles = document.querySelector('#fileinput');
    uploadfiles.addEventListener('change', function () {
		$("#gallery").html("");
        var files = this.files;
        if(files.length>5)
		{
			$("#_btnSubmit").html('<font color="maroon"><b>En Fazla 5 Adet Resim Seçiniz!</b></font>');
			alert("En Fazla 5 Adet Resim Seçiniz!");
		}else{
			for(var i=0; i<files.length; i++){
				previewImage(this.files[i]);
			}
			$("#_btnSubmit").html('<input type="submit" value="İlanı Yayınla" class="btn btn-primary" />');
		}

    }, false);
})();
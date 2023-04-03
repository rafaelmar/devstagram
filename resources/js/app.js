import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Upload Your Image',
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true, //para eliminar
    dictRemoveFile: 'Delete', //el boton para eliminar
    maxFiles: 1, // cantidad maxima de archivos para subir
    uploadMultiple: false,

    init: function(){
        if(document.querySelector('[name="image"]').value.trim()){

            const postImage = {}
            postImage.size = 1234;
            postImage.name = document.querySelector('name="image"').value

            this.options.addedfile.call(this, postImage);
            this.options.thumbnail.call(this, postImage, `/uploads/${postImage.name}`)

            postImage.previewElement.classList.add("dz-succes", "dz-complete")

            
        };
    }
});

// dropzone.on("sending", function(file, xhr, formData)
// {
//     console.log(file);
// });

dropzone.on("success", function(file, response)
{
    console.log(response.file);// esta "file" es el que esta dentro del return de "ImageController" y accedemos a el con el "." para que solo imprima la respuesta del uuid con su respectiva extension
    document.querySelector('[name="image"]').value = response.file;
});

// dropzone.on("error", function(file, message)
// {
//     console.log(message);
// });

dropzone.on("removedfile", function(){
    document.querySelector('[name="image"]').value = '';
});
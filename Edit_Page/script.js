tinymce.init({
    selector: '#editor',
    language: 'es_MX',
    branding: false,
    menubar: false,
    statusbar: false,
    toolbar: 'undo redo | styles forecolor | bold italic | alignleft aligncenter aligright alignjustify | bullist numlist outdent indent | emoticons | image',
    plugins: 'emoticons | lists | image',
    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    /*
        URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
        images_upload_url: 'postAcceptor.php',
        here we add custom filepicker only to Image dialog
    */
    file_picker_types: 'image',
    /* and here's our custom image picker*/
    file_picker_callback: (cb, value, meta) => {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        input.addEventListener('change', (e) => {
        const file = e.target.files[0];

        const reader = new FileReader();
        reader.addEventListener('load', () => {
            /*
            Note: Now we need to register the blob in TinyMCEs image blob
            registry. In the next release this part hopefully won't be
            necessary, as we are looking to handle it internally.
            */
            const id = 'blobid' + (new Date()).getTime();
            const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            const base64 = reader.result.split(',')[1];
            const blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            /* call the callback and populate the Title field with the file name */
            cb(blobInfo.blobUri(), { title: file.name });
        });
        reader.readAsDataURL(file);
        });

        input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});

// Assuming we're keeping the existing TinyMCE initialization
// Add this to your script.js

/* const formulario = document.getElementById('formulario');
formulario.addEventListener('submit', (e) => {
    e.preventDefault();
    
    // Get the content from TinyMCE editor
    const contenido = tinymce.activeEditor.getContent();
    console.log(contenido);
    // Get the selected option
    const opciones = document.getElementsByName('intereses');
    let opcionSeleccionada = '';
    for (const opcion of opciones) {
        if(opcion.checked) {
            opcionSeleccionada = opcion.value;
            break;
        }
    }m
    
    
    // Reset the form
    formulario.reset();
}); */

/* document.getElementById('formulario').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir recarga de la página

    // Obtener el contenido del editor
    const editorContent = tinymce.get('editor').getContent();

    // Obtener el valor del campo radio seleccionado
    const radioValue = document.querySelector('input[name="intereses"]:checked')?.value;

    if (!radioValue) {
        alert("Por favor selecciona un interés");
        return;
    }

    // Crear un objeto FormData para enviar al servidor
    const formData = new FormData();
    formData.append('contenido', editorContent);
    formData.append('intereses', radioValue);

    // Enviar los datos al servidor
    fetch('savenews.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log('Raw response:', response);
    })
    .then(data => {
        console.log('PIPIPIPIP');
        console.log('Parsed response:', data);
        if (data.success) {
            console.log('Data sent');
            alert(data.message);
        } else {
            print('Data Error');
            alert('Error: ' + data.message);
        }
    })
    // .catch(error => {
     //   console.error('Error:', error);
     //   alert('Ocurrió un error al enviar el formulario.');
    //}); 
    console.log(editorContent);
    // window.location.href = "http://localhost/hic_test/Home_Page"
}); */

document.getElementById('formulario').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir recarga de la página

    // Obtener el contenido del editor
    const editorContent = tinymce.get('editor').getContent();
    console.log('Contenido ---- ',editorContent);
    // Obtener el título
    const title = document.getElementById('tittle').value;
    console.log('Titulo ----- ',title);

    // Obtener la imagen
    const imageFile = document.getElementById('fileInput').files[0];
    console.log('Image info ----',imageFile);

    // Validar campos requeridos
    if (!title || !editorContent || !imageFile) {
        alert("Por favor completa todos los campos requeridos.");
        return;
    }

    // Obtener el valor del campo radio seleccionado
    const radioValue = document.querySelector('input[name="intereses"]:checked')?.value;
    console.log('Categoria ----',radioValue);

    if (!radioValue) {
        alert("Por favor selecciona un interés.");
        return;
    }

    // Crear un objeto FormData para enviar al servidor
    const formData = new FormData();
    formData.append('titulo', title);
    formData.append('contenido', editorContent);
    formData.append('intereses', radioValue);
    formData.append('main_image', imageFile);

    // Enviar los datos al servidor
    fetch('savenews.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            document.getElementById('formulario').reset(); // Resetear el formulario
            tinymce.get('editor').setContent(''); // Vaciar el editor
        } else {
            alert('Error: ' + data.message);
        }
    })
    /* .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error al enviar el formulario.');
    }); */

    window.location.href = "http://localhost/hic_test/Home_Page"
});

const navToggle = document.querySelector(".nav-menu_toggle"),
      navMenu = document.querySelector(".nav_menu"),
      navClose = document.querySelector(".nav-menu_close");


if (navToggle) {
    navToggle.addEventListener("click", () => {
        navMenu.classList.add("show-menu")
    })
}

if (navClose) {
    navClose.addEventListener("click", () => {
        navMenu.classList.remove("show-menu")
    })
}


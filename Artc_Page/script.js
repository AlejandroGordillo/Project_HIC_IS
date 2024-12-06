
tinymce.init({
    selector: '#editor',
    language: 'es_MX',
    branding: false,
    menubar: false,
    statusbar: false,
    toolbar: 'undo redo | styles forecolor | bold italic | alignleft aligncenter aligright alignjustify | bullist numlist outdent indent | emoticons | image',
    plugins: 'emoticons | lists | image',
    image_title: true,
    automatic_uploads: true,
    file_picker_types: 'image',
    file_picker_callback: (cb, value, meta) => {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.addEventListener('load', () => {
                const id = 'blobid' + (new Date()).getTime();
                const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                const base64 = reader.result.split(',')[1];
                const blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), { title: file.name });
            });
            reader.readAsDataURL(file);
        });
        input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});

const formulario = document.getElementById('formulario');
formulario.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const contenido = tinymce.activeEditor.getContent();
    const opciones = document.getElementsByName('intereses');
    let categoria = '';
    for (const opcion of opciones) {
        if(opcion.checked) {
            categoria = opcion.value;
            break;
        }
    }
    
    const imagePlaceholder = document.querySelector('.image-placeholder');
    const imagen = imagePlaceholder.querySelector('img')?.src || null;
    const titulo = document.querySelector('.header-main h1').textContent.trim();
    
    try {
        const response = await fetch('../article-handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                titulo,
                contenido,
                imagen,
                categoria,
                estado: 'publicado'
            })
        });

        if (!response.ok) throw new Error('Error al publicar');

        const data = await response.json();
        if (data.success) {
            alert('Artículo publicado exitosamente');
            tinymce.activeEditor.setContent('');
            imagePlaceholder.innerHTML = 'Inserte Imagen';
            document.querySelector('.header-main h1').textContent = '[ Titulo ]';
            opciones.forEach(opcion => opcion.checked = false);
        }
        
    } catch (error) {
        console.error('Error:', error);
        alert('Error al publicar el artículo');
    }
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
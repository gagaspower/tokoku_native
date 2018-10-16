tinymce.init({
    selector: "textarea#loko",
    theme: "modern",
    height: 450,
       codesample_languages: [
        {text: 'HTML/XML', value: 'markup'},
        {text: 'JavaScript', value: 'javascript'},
        {text: 'CSS', value: 'css'},
        {text: 'PHP', value: 'php'},
        {text: 'Java', value: 'java'},
    ],
    plugins: [
					"advlist autolink link image lists charmap print preview hr anchor pagebreak",
					"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
					"table contextmenu directionality emoticons paste textcolor",
					"code fullscreen codesample"
				],
				menubar : false,
				toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent table | image | codesample ",
				//toolbar2: "| fontsizeselect | styleselect | link unlink anchor |  image media | forecolor backcolor | code codesample fullscreen ",
				image_advtab: true,
				fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",

});
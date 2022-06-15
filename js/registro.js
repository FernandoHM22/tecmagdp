$("#supervisores").load(
  "../procesos/informacionUsuarios/selectSupervisores.php"
);

document.getElementById("nombres").addEventListener("input", forceLower);
document.getElementById("apellidos").addEventListener("input", forceLower);

$("input[name='radioRegion']").click(function () {
  $(".btnRegister").css("background-color", "#007a81");
});
// Event handling functions are automatically passed a reference to the
// event that triggered them as the first argument (evt)
function forceLower(evt) {
  // Get an array of all the words (in all lower case)
  var words = evt.target.value.toLowerCase().split(/\s+/g);

  // Loop through the array and replace the first letter with a cap
  var newWords = words.map(function (element) {
    // As long as we're not dealing with an empty array element, return the first letter
    // of the word, converted to upper case and add the rest of the letters from this word.
    // Return the final word to a new array
    return element !== ""
      ? element[0].toUpperCase() + element.substr(1, element.length)
      : "";
  });

  // Replace the original value with the updated array of capitalized words.
  evt.target.value = newWords.join(" ");
}
$(document).on("click", ".btn-group-toggle .btn-switch", function (e) {
  var btn_switch = $(this).data("switch");
  $(this)
    .parent()
    .removeClass("switch-on switch-off")
    .toggleClass("switch-" + btn_switch);
});



var resize = $("#upload-demo").croppie({
  enableExif: true,
  enableOrientation: true,
  viewport: {
    // Default { width: 100, height: 100, type: 'square' }
    width: 150,
    height: 150,
    type: "circle", //square
  },
  boundary: {
    width: 200,
    height: 200,
  },
});

$(".custom-file-input").on("change", function () {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function validarFile(all) {
  var extensiones_permitidas = [".png", ".jpg", ".jpeg", ".PNG", ".JPG"];
  var tamano = 8;
  var rutayarchivo = all.value;
  var ultimo_punto = all.value.lastIndexOf(".");
  var extension = rutayarchivo.slice(ultimo_punto, rutayarchivo.length);
  if (extensiones_permitidas.indexOf(extension) == -1) {
    alert(
      "Extensión de archivo no valida, por favor seleccionar una imagen..."
    );
    document.getElementById(all.id).value = "";
    return;
  }
  if (all.files[0].size / 1048576 > tamano) {
    alert("El archivo no puede superar los " + tamano + " MB");
    document.getElementById(all.id).value = "";
    return;
  }
}

$("#customFile").on("change", function () {
  var reader = new FileReader();
  reader.onload = function (e) {
    resize
      .croppie("bind", {
        url: e.target.result,
      })
      .then(function () {
        
        console.log("jQuery bind complete");
      });
  };
  reader.readAsDataURL(this.files[0]);
});

$("#formRegistro").submit(function (event) {
  event.preventDefault();
  resize
    .croppie("result", {
      type: "canvas",
      size: "viewport",
    })
    .then(function (img) {
      var token = tokenRegistro;
      var no_reloj = $("input[name='no_reloj']").val();
      var nombres = $("input[name='nombres']").val();
      var apellidos = $("input[name='apellidos']").val();
      var pass = $("input[name='pass']").val();
      var repass = $("input[name='repass']").val();
      var correo = $("input[name='correo']").val();
      var puesto = $("input[name='puesto']").val();
      var depto = $("#depto").val();
      var supervisor = $("#supervisor").val();
      var radioSupervisor = $("input[name='radioSupervisor']:checked").val();
      var radioRegion = $("input[name='radioRegion']:checked").val();

    //   console.log(token);
    //   console.log(no_reloj);
    //   console.log(nombres);
    //   console.log(apellidos);
    //   console.log(pass);
    //   console.log(repass);
    //   console.log(correo);
    //   console.log(puesto);
    //   console.log(depto);
    //   console.log(supervisor);
    //   console.log(radioSupervisor);
    //   console.log(radioRegion);
    //   console.log(img);

      $.ajax({
        url: "../ajax/perfil/ajax_register.php",
        type: "POST",
        data: {
          token: token,
          no_reloj: no_reloj,
          nombres: nombres,
          apellidos: apellidos,
          pass: pass,
          repass: repass,
          correo: correo,
          puesto: puesto,
          depto: depto,
          supervisor: supervisor,
          radioSupervisor: radioSupervisor,
          radioRegion: radioRegion,
          file: img,
        },
        success: function (data) {
          $("#displaymessage").html(data);
          $('input[type="text"]').val("");
          $('input[type="email"]').val("");
          $('input[type="number"]').val("");
          $('input[type="password"]').val("");
          $("select option").remove();
          $('input[name="radioSupervisor"]').attr("checked", false);
          $('input[name="radioRegion"]').attr("checked", false);
          $("#upload-demo").hide();
        },
      });
    });
});

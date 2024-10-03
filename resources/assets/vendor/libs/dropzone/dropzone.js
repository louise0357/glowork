import Dropzone from 'dropzone/dist/dropzone';

Dropzone.autoDiscover = false;

// File upload progress animation
Dropzone.options.dropzoneBasic = {
  paramName: 'file', // Sunucuya gönderilecek dosya adı
  maxFilesize: 5, // MB cinsinden maksimum dosya boyutu
  acceptedFiles: '.jpeg,.jpg,.png,.gif,.pdf', // Kabul edilen dosya türleri
  addRemoveLinks: true,
  init: function() {
    this.on("success", function(file, response) {
      console.log("Dosya başarıyla yüklendi:", response);
    });
    this.on("error", function(file, response) {
      console.log("Yükleme hatası:", response);
    });
  }
};


try {
  window.Dropzone = Dropzone;
} catch (e) {}

export { Dropzone };

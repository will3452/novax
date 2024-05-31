<html>
  <head>
    <meta charset="utf-8" />
    <script src="https://unpkg.com/pdf-lib"></script>
  </head>

  <body>
    <iframe id="pdf" style="width: 100%; height: 100%;"></iframe>
  </body>

  <script>
    // createPdf();

    // async function createPdf() {
    //   const pdfDoc = await PDFLib.PDFDocument.create();
    //   const page = pdfDoc.addPage([350, 400]);
    //   page.moveTo(110, 200);
    //   page.drawText('Hello World!');
    //   const pdfDataUri = await pdfDoc.saveAsBase64({ dataUri: true });
    //   document.getElementById('pdf').src = pdfDataUri;
    // }
    getForm(); 
    async function getForm() {
        const formUrl = '/progress-form.pdf'; 
        const formBytes = await fetch(formUrl).then(res => res.arrayBuffer()); 

        const pdfDoc = await PDFLib.PDFDocument.load(formBytes);

        const form = pdfDoc.getForm();
        
        const fields = form.getFields()
        fields.forEach(field => {
        const type = field.constructor.name
        const name = field.getName()
        if (type != 'e') {
            form.getTextField(name).setText(name); 
        }
        console.log(`${type}: ${name}`)
        }); 

      form.getTextField('Text1').setText(`{{$progress->section->course->name}}`); 
      form.getTextField('Text2').setText(`{{$progress->section->course->code}}`); 
      form.getTextField('Text3').setText(`{{$progress->section->section}}`); 
      form.getTextField('Text4').setText(`{{$progress->section->school_year}} {{$progress->section->term}}`); 
      form.getTextField('Text5').setText(`{{$progress->group->title->title}}`); 
      form.getTextField('Text8').setText(`{{$progress->group->code}}`); 
      form.getTextField('Text30').setText(`{{$progress->description}}`); 
      form.getTextField('Text10').setText(`{{$progress->group->defense_schedule}}`); 
      form.getTextField('Text28').setText(`{{$progress->week}}`); 
      form.getTextField('Text16').setText(`{{$progress->group->groupMembers[0]->student->name}}`)
      form.getTextField('Text19').setText(`{{$progress->group->groupMembers[0]->student->number}}`)
      form.getTextField('Text9').setText(``);  // endorse by
      form.getTextField('Text12').setText(``);  // coordinator 
      form.getTextField('Text11').setText(``);  // adviser 
      form.getTextField('Text29').setText(`{{$progress->from_date->format('m-d')}} - {{$progress->to_date->format('m-d, y')}}`); 
    //   form.getTextField('Text4').setText(`{{$progress->section->school_year}}`); 
      form.flatten();
      const pdfDataUri = await pdfDoc.saveAsBase64({ dataUri: true });
      document.getElementById('pdf').src = pdfDataUri;
    }
  </script>
</html>
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

    async function getSignature(url) {
      return await fetch(url).then(res => res.arrayBuffer()); 
    }

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
        // if (type == 'e' && name.includes('Check')) {
        //   const checkBox = form.getCheckBox(name)
        // checkBox.check()
        // }
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
      form.getTextField('Text22').setText(`{{$progress->group->groupMembers[0]->student->course}}`)
      // get signature of student 
      const sig1 = await getSignature(`/storage/{{$progress->group->groupMembers[0]->student->signature}}`)
      const eSig1 = await pdfDoc.embedPng(sig1); 
      form.getTextField('Text25').setImage(eSig1); 

      @if(array_key_exists(1, $progress->group->groupMembers->toArray()))
        form.getTextField('Text17').setText(`{{$progress->group->groupMembers[1]->student->name}}`)
        form.getTextField('Text20').setText(`{{$progress->group->groupMembers[1]->student->number}}`)
        form.getTextField('Text23').setText(`{{$progress->group->groupMembers[1]->student->course}}`)
        const sig2 = await getSignature(`/storage/{{$progress->group->groupMembers[1]->student->signature}}`)
        const eSig2 = await pdfDoc.embedPng(sig2); 
        form.getTextField('Text26').setImage(eSig2); 
      @else 
        form.getTextField('Text17').setText(``)
        form.getTextField('Text20').setText(``)
        form.getTextField('Text23').setText(``)
        form.getTextField('Text26').setText(``)
      @endif 

      @if(array_key_exists(2, $progress->group->groupMembers->toArray()))
        form.getTextField('Text18').setText(`{{$progress->group->groupMembers[2]->student->name}}`)
        form.getTextField('Text21').setText(`{{$progress->group->groupMembers[2]->student->number}}`)
        form.getTextField('Text24').setText(`{{$progress->group->groupMembers[2]->student->course}}`)
        const sig3 = await getSignature(`/storage/{{$progress->group->groupMembers[2]->student->signature}}`)
        const eSig3 = await pdfDoc.embedPng(sig3); 
        form.getTextField('Text27').setImage(eSig3); 
      @else 
        form.getTextField('Text18').setText(``)
        form.getTextField('Text21').setText(``)
        form.getTextField('Text24').setText(``)
        form.getTextField('Text27').setText(``)
      @endif 
      
      @if($progress->group->title->ic_type == 'Thesis' ) 
        form.getCheckBox('Check Box6').check(); 
      @endif 

      @if($progress->group->title->ic_type == 'Capstone' ) 
        form.getCheckBox('Check Box9').check(); 
      @endif 

      @if($progress->group->title->ic_type == 'Feasibility Study' ) 
        form.getCheckBox('Check Box10').check(); 
      @endif 

      @if($progress->group->title->ic_type == 'Plant Design' ) 
        form.getCheckBox('Check Box11').check(); 
      @endif 

      @if($progress->group->title->ic_type == 'Business Plan' ) 
        form.getCheckBox('Check Box12').check(); 
      @endif 

      @if($progress->section->thesis_phase == 'Proposal' ) 
        form.getCheckBox('Check Box13').check(); 
      @endif 

      @if($progress->section->thesis_phase == 'Data Gathering' ) 
        form.getCheckBox('Check Box14').check(); 
      @endif 
      @if($progress->section->thesis_phase == 'Final' ) 
        form.getCheckBox('Check Box15').check(); 
      @endif 




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
<x-form>
    <iframe id="pdf" style="width: 100%; height: 85vh;"></iframe>

<script>
    async function getSignature(url) {
        return await fetch(url).then(res => res.arrayBuffer());
    }
  </script>
  @if (request()->form == 'progress')
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
                  // if (type == 'e' && name.includes('Check')) {
                  //   const checkBox = form.getCheckBox(name)
                  // checkBox.check()
                  // }
                  console.log(`${type}: ${name}`)
              });

              form.getTextField('Text1').setText(`{{ $progress->section->course->name }}`);
              form.getTextField('Text2').setText(`{{ $progress->section->course->code }}`);
              form.getTextField('Text3').setText(`{{ $progress->section->section }}`);
              form.getTextField('Text4').setText(`{{ $progress->section->school_year }} {{ $progress->section->term }}`);
              form.getTextField('Text5').setText(`{{ $progress->group->title->title }}`);
              form.getTextField('Text8').setText(`{{ $progress->group->code }}`);
              form.getTextField('Text30').setText(`{{ $progress->description }}`);
              form.getTextField('Text10').setText(`{{ $progress->group->defense_schedule }}`);
              form.getTextField('Text28').setText(`{{ $progress->week }}`);
              form.getTextField('Text16').setText(`{{ $progress->group->groupMembers[0]->student->name }}`)
              form.getTextField('Text19').setText(`{{ $progress->group->groupMembers[0]->student->number }}`)
              form.getTextField('Text22').setText(`{{ $progress->group->groupMembers[0]->student->course }}`)
              // get signature of student
              try {
                  const sig1 = await getSignature(`/storage/{{ $progress->group->groupMembers[0]->student->signature }}`)
                  const eSig1 = await pdfDoc.embedPng(sig1);
                  form.getTextField('Text25').setImage(eSig1);
              } catch(error) {

              }

              @if (array_key_exists(1, $progress->group->groupMembers->toArray()))
                  form.getTextField('Text17').setText(`{{ $progress->group->groupMembers[1]->student->name }}`)
                  form.getTextField('Text20').setText(`{{ $progress->group->groupMembers[1]->student->number }}`)
                  form.getTextField('Text23').setText(`{{ $progress->group->groupMembers[1]->student->course }}`)
                  try {
                    const sig2 = await getSignature(`/storage/{{ $progress->group->groupMembers[1]->student->signature }}`)
                  const eSig2 = await pdfDoc.embedPng(sig2);
                  form.getTextField('Text26').setImage(eSig2);
                  } catch(err) {}
              @else
                  form.getTextField('Text17').setText(``)
                  form.getTextField('Text20').setText(``)
                  form.getTextField('Text23').setText(``)
                  form.getTextField('Text26').setText(``)
              @endif

              @if (array_key_exists(2, $progress->group->groupMembers->toArray()))
                  form.getTextField('Text18').setText(`{{ $progress->group->groupMembers[2]->student->name }}`)
                  form.getTextField('Text21').setText(`{{ $progress->group->groupMembers[2]->student->number }}`)
                  form.getTextField('Text24').setText(`{{ $progress->group->groupMembers[2]->student->course }}`)
                  try {
                      const sig3 = await getSignature(`/storage/{{ $progress->group->groupMembers[2]->student->signature }}`)
                      const eSig3 = await pdfDoc.embedPng(sig3);
                      form.getTextField('Text27').setImage(eSig3);
                  } catch (error) {

                  }
              @else
                  form.getTextField('Text18').setText(``)
                  form.getTextField('Text21').setText(``)
                  form.getTextField('Text24').setText(``)
                  form.getTextField('Text27').setText(``)
              @endif

              @if ($progress->group->title->ic_type == 'Thesis')
                  form.getCheckBox('Check Box6').check();
              @endif

              @if ($progress->group->title->ic_type == 'Capstone')
                  form.getCheckBox('Check Box9').check();
              @endif

              @if ($progress->group->title->ic_type == 'Feasibility Study')
                  form.getCheckBox('Check Box10').check();
              @endif

              @if ($progress->group->title->ic_type == 'Plant Design')
                  form.getCheckBox('Check Box11').check();
              @endif

              @if ($progress->group->title->ic_type == 'Business Plan')
                  form.getCheckBox('Check Box12').check();
              @endif

              @if ($progress->section->thesis_phase == 'Proposal')
                  form.getCheckBox('Check Box13').check();
              @endif

              @if ($progress->section->thesis_phase == 'Data Gathering')
                  form.getCheckBox('Check Box14').check();
              @endif
              @if ($progress->section->thesis_phase == 'Final')
                  form.getCheckBox('Check Box15').check();
              @endif




              form.getTextField('Text9').setText(``); // endorse by
              form.getTextField('Text12').setText(``); // coordinator
              form.getTextField('Text11').setText(``); // adviser
              form.getTextField('Text29').setText(
                  `{{ $progress->from_date->format('m-d') }} - {{ $progress->to_date->format('m-d, y') }}`);
              //   form.getTextField('Text4').setText(`{{ $progress->section->school_year }}`);
              form.flatten();
              const pdfDataUri = await pdfDoc.saveAsBase64({
                  dataUri: true
              });
              document.getElementById('pdf').src = pdfDataUri;
          }
      </script>
  @endif

  @if (request()->form == 'oral_defense')
      <script>
        getForm()

        async function getForm() {
              const formUrl = '/oral-defense-request.pdf';
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

              form.getTextField('Text1').setText('{{$oral_defense->section->course->name}}')
              form.getTextField('Text2').setText('{{$oral_defense->section->course->code}}')
              form.getTextField('Text3').setText('{{$oral_defense->section->section}}')
              form.getTextField('Text4').setText('{{$oral_defense->section->school_year}} {{$oral_defense->section->term}}')
              form.getTextField('Text5').setText('{{$oral_defense->group->title->title}}')
              form.getTextField('Text6').setText('{{$oral_defense->group->code}}')
              form.getTextField('Text15').setText('{{$oral_defense->date->format("m/d/Y")}}')
              form.getTextField('Text16').setText('{{$oral_defense->time}}')
              form.getTextField('Text17').setText('{{$oral_defense->venue}}')
              // student 1
              form.getTextField('Text18').setText(`{{ $oral_defense->group->groupMembers[0]->student->name }}`)
              form.getTextField('Text21').setText(`{{ $oral_defense->group->groupMembers[0]->student->number }}`)
              form.getTextField('Text24').setText(`{{ $oral_defense->group->groupMembers[0]->student->course }}`)
              form.getTextField('Text27').setText(``)
              // get signature of student
              try {
                const sig1 = await getSignature(`/storage/{{ $oral_defense->group->groupMembers[0]->student->signature }}`)
              const eSig1 = await pdfDoc.embedPng(sig1);
              form.getTextField('Text30').setImage(eSig1);
              } catch (error) {}


              @if (array_key_exists(1, $oral_defense->group->groupMembers->toArray()))
                  form.getTextField('Text19').setText(`{{ $oral_defense->group->groupMembers[1]->student->name }}`)
                  form.getTextField('Text22').setText(`{{ $oral_defense->group->groupMembers[1]->student->number }}`)
                  form.getTextField('Text25').setText(`{{ $oral_defense->group->groupMembers[1]->student->course }}`)
                  form.getTextField('Text28').setText(``)
                  try {
                    const sig2 = await getSignature(`/storage/{{ $oral_defense->group->groupMembers[1]->student->signature }}`)
                  const eSig2 = await pdfDoc.embedPng(sig2);
                  form.getTextField('Text31').setImage(eSig2);
                  } catch (err) {}
              @else
                  form.getTextField('Text19').setText(``)
                  form.getTextField('Text22').setText(``)
                  form.getTextField('Text25').setText(``)
                  form.getTextField('Text28').setText(``)
                  form.getTextField('Text31').setText(``)
              @endif

              @if (array_key_exists(2, $oral_defense->group->groupMembers->toArray()))
                  form.getTextField('Text20').setText(`{{ $oral_defense->group->groupMembers[2]->student->name }}`)
                  form.getTextField('Text23').setText(`{{ $oral_defense->group->groupMembers[2]->student->number }}`)
                  form.getTextField('Text26').setText(`{{ $oral_defense->group->groupMembers[2]->student->course }}`)
                  form.getTextField('Text29').setText(``)
                  try {
                    const sig3 = await getSignature(`/storage/{{ $oral_defense->group->groupMembers[2]->student->signature }}`)
                  const eSig3 = await pdfDoc.embedPng(sig3);
                  form.getTextField('Text32').setImage(eSig3);
                  } catch (err) {}
              @else
                  form.getTextField('Text20').setText(``)
                  form.getTextField('Text23').setText(``)
                  form.getTextField('Text26').setText(``)
                  form.getTextField('Text29').setText(``)
                  form.getTextField('Text32').setText(``)
              @endif
              // PANELIST
              form.getTextField('Text33').setText(`{{$oral_defense->group->panellists()->whereType('Adviser')->first()->faculty->name}}`)
              @if($oral_defense->group->panellists()->whereType('Adviser')->first()->faculty->signature)
                try {
                    const p1 = await getSignature(`/storage/{{ $oral_defense->group->panellists()->whereType('Adviser')->first()->faculty->signature }}`)
                    const ep1 = await pdfDoc.embedPng(p1);
                    form.getTextField('Text36').setImage(ep1)
                } catch (error) {

                }
              @else

              form.getTextField('Text36').setText('')
              @endif
              form.getTextField('Text39').setText('')

              form.getTextField('Text34').setText(`{{$oral_defense->group->panellists()->whereType('Chair')->first()->faculty->name}}`)
              @if($oral_defense->group->panellists()->whereType('Chair')->first()->faculty->signature)
                try {
                    const p2 = await getSignature(`/storage/{{ $oral_defense->group->panellists()->whereType('Chair')->first()->faculty->signature }}`)
                    const ep2 = await pdfDoc.embedPng(p2);
                    form.getTextField('Text37').setImage(ep2)
                } catch (error) {

                }
              @else
              form.getTextField('Text37').setText('')
              @endif
              form.getTextField('Text40').setText('')

              form.getTextField('Text35').setText(`{{$oral_defense->group->panellists()->whereType('Member')->first()->faculty->name}}`)
              @if($oral_defense->group->panellists()->whereType('Member')->first()->faculty->signature)
                try {
                    const p3 = await getSignature(`/storage/{{ $oral_defense->group->panellists()->whereType('Member')->first()->faculty->signature }}`)
                    const ep3 = await pdfDoc.embedPng(p3);
                    form.getTextField('Text38').setImage(ep3)
                } catch() {

                }
              @else
              form.getTextField('Text38').setText('')
              @endif
              form.getTextField('Text41').setText('')

              form.getTextField('Text42').setText('{{\App\Models\User::find(nova_get_setting("coordinator_id", 1))->name}}')
              form.getTextField('Text43').setText('{{\App\Models\User::find(nova_get_setting("programchair_id", 1))->name}}')

              // CHECKBOX

              @if ($oral_defense->group->title->ic_type == 'Thesis')
                  form.getCheckBox('Check Box7').check();
              @endif

              @if ($oral_defense->group->title->ic_type == 'Capstone')
                  form.getCheckBox('Check Box8').check();
              @endif

              @if ($oral_defense->group->title->ic_type == 'Feasibility Study')
                  form.getCheckBox('Check Box9').check();
              @endif

              @if ($oral_defense->group->title->ic_type == 'Plant Design')
                  form.getCheckBox('Check Box11').check();
              @endif

              @if ($oral_defense->group->title->ic_type == 'Business Plan')
                  form.getCheckBox('Check Box12').check();
              @endif

              @if ($oral_defense->section->thesis_phase == 'Proposal')
                  form.getCheckBox('Check Box13').check();
              @endif
              @if ($oral_defense->section->thesis_phase == 'Final')
                  form.getCheckBox('Check Box14').check();
              @endif



              form.flatten();
              const pdfDataUri = await pdfDoc.saveAsBase64({
                  dataUri: true
              });
              document.getElementById('pdf').src = pdfDataUri;
          }
      </script>
  @endif

  @if (request()->form == 'acceptance')
      <script>
        getForm()

        async function getForm() {
              const formUrl = '/acceptance.pdf';
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

              form.getTextField('Course').setText('{{$group->title->section->course->name}}')
              form.getTextField('Course Code').setText('{{$group->title->section->course->code}}')
              form.getTextField('Section').setText('{{$group->title->section->section}}')
              form.getTextField('SY/TERM').setText('{{$group->title->section->school_year}} {{$group->title->section->term}}')
              form.getTextField('Tentative Title of Research Project').setText('{{$group->title->title}}')
              form.getTextField('Group Code').setText('{{$group->code}}')
              // form.getTextField('Text16').setText('{{$group->time}}')
              // form.getTextField('Text17').setText('{{$group->venue}}')

              // // student 1
              form.getTextField('Text31').setText(`{{ $group->groupMembers[0]->student->name }}`)
              form.getTextField('Text34').setText(`{{ $group->groupMembers[0]->student->number }}`)
              form.getTextField('Text37').setText(`{{ $group->groupMembers[0]->student->course }}`)
              form.getTextField('Text40').setText(``)
              // // get signature of student
              try {
                const sig1 = await getSignature(`/storage/{{ $group->groupMembers[0]->student->signature }}`)
              const eSig1 = await pdfDoc.embedPng(sig1);
              form.getTextField('Text43').setImage(eSig1);
              } catch (error) {}


              @if (array_key_exists(1, $group->groupMembers->toArray()))
                  form.getTextField('Text32').setText(`{{ $group->groupMembers[1]->student->name }}`)
                  form.getTextField('Text35').setText(`{{ $group->groupMembers[1]->student->number }}`)
                  form.getTextField('Text38').setText(`{{ $group->groupMembers[1]->student->course }}`)
                  form.getTextField('Text41').setText(``)
                  const sig2 = await getSignature(`/storage/{{ $group->groupMembers[1]->student->signature }}`)
                  const eSig2 = await pdfDoc.embedPng(sig2);
                  form.getTextField('Text44').setImage(eSig2);
              @else
                  form.getTextField('Text32').setText(``)
                  form.getTextField('Text35').setText(``)
                  form.getTextField('Text38').setText(``)
                  form.getTextField('Text41').setText(``)
                  form.getTextField('Text44').setText(``)
              @endif

              @if (array_key_exists(2, $group->groupMembers->toArray()))
                  form.getTextField('Text33').setText(`{{ $group->groupMembers[2]->student->name }}`)
                  form.getTextField('Text36').setText(`{{ $group->groupMembers[2]->student->number }}`)
                  form.getTextField('Text39').setText(`{{ $group->groupMembers[2]->student->course }}`)
                  form.getTextField('Text42').setText(``)
                  const sig3 = await getSignature(`/storage/{{ $group->groupMembers[2]->student->signature }}`)
                  const eSig3 = await pdfDoc.embedPng(sig3);
                  form.getTextField('Text45').setImage(eSig3);
              @else
                  form.getTextField('Text33').setText(``)
                  form.getTextField('Text36').setText(``)
                  form.getTextField('Text39').setText(``)
                  form.getTextField('Text42').setText(``)
                  form.getTextField('Text45').setText(``)
              @endif

              // PANELIST
              form.getTextField('Text50').setText(`{{$group->panellists()->whereType('Adviser')->first()->faculty->name}}`)
              form.getTextField('Text46').setText(`{{$group->panellists()->whereType('Adviser')->first()->faculty->name}}`)
              form.getTextField('Text53').setText(``) // relevant degree
              form.getTextField('Text47').setText(``) // relevant degree
              form.getTextField('Text60').setText(``) // date
              form.getTextField('Text49').setText(``) // date
              @if($group->panellists()->whereType('Adviser')->first()->faculty->signature)
                const p1 = await getSignature(`/storage/{{ $group->panellists()->whereType('Adviser')->first()->faculty->signature }}`)
                const ep1 = await pdfDoc.embedPng(p1);
                form.getTextField('Signature58_es_:signer:signature').setImage(ep1)
                form.getTextField('Signature48_es_:signer:signature').setImage(ep1)
              @else

              form.getTextField('Signature58_es_:signer:signature').setText('')
              form.getTextField('Signature48_es_:signer:signature').setText('')
              @endif

              form.getTextField('Text51').setText(`{{$group->panellists()->whereType('Chair')->first()->faculty->name}}`)
              form.getTextField('Text54').setText(``) // relevant degree
              form.getTextField('Text61').setText(``) // date
              @if($group->panellists()->whereType('Chair')->first()->faculty->signature)
                const p2 = await getSignature(`/storage/{{ $group->panellists()->whereType('Chair')->first()->faculty->signature }}`)
                const ep2 = await pdfDoc.embedPng(p2);
                form.getTextField('Signature57_es_:signer:signature').setImage(ep2)
              @else
              form.getTextField('Signature57_es_:signer:signature').setText('')
              @endif

              form.getTextField('Text52').setText(`{{$group->panellists()->whereType('Member')->first()->faculty->name}}`)
              form.getTextField('Text55').setText(``) // relevant degree
              form.getTextField('Text62').setText(``) // date
              @if($group->panellists()->whereType('Member')->first()->faculty->signature)
                const p3 = await getSignature(`/storage/{{ $group->panellists()->whereType('Member')->first()->faculty->signature }}`)
                const ep3 = await pdfDoc.embedPng(p3);
                form.getTextField('Signature59_es_:signer:signature').setImage(ep3)
              @else
              form.getTextField('Signature59_es_:signer:signature').setText('')
              @endif

              form.getTextField('Text65').setText('{{\App\Models\User::find(nova_get_setting("coordinator_id", 1))->name}}')
              form.getTextField('Text63').setText('{{\App\Models\User::find(nova_get_setting("programchair_id", 1))->name}}')
              form.getTextField('Text64').setText('{{\App\Models\User::whereType("Dean")->first()->name}}')

              // // CHECKBOX
              @if ($group->title->ic_type == 'Thesis')
                  form.getCheckBox('Check Box23').check();
              @endif

              @if ($group->title->ic_type == 'Capstone')
                  form.getCheckBox('Check Box24').check();
              @endif

              @if ($group->title->ic_type == 'Feasibility Study')
                  form.getCheckBox('Check Box25').check();
              @endif

              @if ($group->title->ic_type == 'Plant Design')
                  form.getCheckBox('Check Box26').check();
              @endif

              @if ($group->title->ic_type == 'Business Plan')
                  form.getCheckBox('Check Box27').check();
              @endif


              @if ($group->title->section->thesis_phase == 'Data Gathering')
                  form.getCheckBox('Check 29').check();
              @endif

              @if ($group->title->section->thesis_phase == 'Proposal')
                  form.getCheckBox('Check Box28').check();
              @endif


              @if ($group->title->section->thesis_phase == 'Final')
                  form.getCheckBox('Check Box30').check();
              @endif




              form.flatten();
              const pdfDataUri = await pdfDoc.saveAsBase64({
                  dataUri: true
              });
              document.getElementById('pdf').src = pdfDataUri;
          }
      </script>
  @endif

  @if(request()->form == 'rubric')
  <script>
      getForm()

      async function getForm() {

          const formUrl = '/rubric.pdf';
          const formBytes = await fetch(formUrl).then(res => res.arrayBuffer());



          const pdfDoc = await PDFLib.PDFDocument.load(formBytes);
          const form = pdfDoc.getForm();

              const fields = form.getFields()
              fields.forEach(field => {
                  const type = field.constructor.name
                  const name = field.getName()
                  if (type != 'e') {
                      // form.getTextField(name).setText(name);
                  }
                  // if (type == 'e' && name.includes('Check')) {
                  //   const checkBox = form.getCheckBox(name)
                  // checkBox.check()
                  // }
                  console.log(`${type}: ${name}`)

              });

              form.getTextField('Presenters').setText('{{implode(",", $group->groupMembers->map( fn ($e) => $e->student->name)->toArray())}}')
              form.getTextField('Title of Study').setText('{{$group->title->title}}')
              form.getTextField('Adviser').setText('{{$group->panellists()->whereType("Adviser")->first()->faculty->name}}')
              form.getTextField('Program').setText('{{$group->groupMembers()->first()->student->course}}')
              form.flatten();
              const pdfDataUri = await pdfDoc.saveAsBase64({
                  dataUri: true
              });
              document.getElementById('pdf').src = pdfDataUri;
      }
  </script>
  @endif

  @if (request()->form == 'revision')
      <script>
        getForm()

        async function getForm() {
              const formUrl = '/revisions.pdf';
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
              try {
                  let __f = form.getField("{{$group->verdict}}")
                  console.log("__f", __f.constructor.name)
                  if (__f.constructor.name != 'e') {
                      form.getTextField("{{$group->verdict}}").setText("H")
                  } else {
                      form.getCheckBox("{{$group->verdict}}").check()
                  }
              } catch (error) {
                  console.log('error -> ', error);
              }

              form.getTextField('COURSE').setText('{{$group->title->section->course->name}}')
              form.getTextField('COURSE CODE').setText('{{$group->title->section->course->code}}')
              form.getTextField('SECTION').setText('{{$group->title->section->section}}')
              form.getTextField('SYTERM').setText('{{$group->title->section->school_year}} {{$group->title->section->term}}')
              form.getTextField('TITLE OF RESEARCH PROJECT').setText('{{$group->title->title}}')
              form.getTextField('GROUP CODE').setText('{{$group->code}}')
              form.getTextField('DATE').setText("{{$group->oralDefenseRequests()->latest()->first()->date->format('m/d/Y')}}")
              form.getTextField('TIME').setText("{{$group->oralDefenseRequests()->latest()->first()->time}}")
              form.getTextField('VENUE').setText("{{$group->oralDefenseRequests()->latest()->first()->venue}}")
              const reF = form.getTextField('undefined_2')
              reF.setFontSize(12)
              reF.setText("{{implode('\n', $group->revisions->map(fn ($e) => '- '.$e->revision)->take(8)->toArray())}}")
              // $group->oralDefenseRequests()->latest()->first()
              // // form.getTextField('Text16').setText('{{$group->time}}')
              // // form.getTextField('Text17').setText('{{$group->venue}}')

              // // // student 1
              form.getTextField('STUDENT 1').setText(`{{ $group->groupMembers[0]->student->name }}`)
              form.getTextField('STUDENT 1_2').setText(`{{ $group->groupMembers[0]->student->name }}`)
              // form.getTextField('Text34').setText(`{{ $group->groupMembers[0]->student->number }}`)
              // form.getTextField('Text37').setText(`{{ $group->groupMembers[0]->student->course }}`)
              // form.getTextField('Text40').setText(``)
              // // // get signature of student
              // const sig1 = await getSignature(`/storage/{{ $group->groupMembers[0]->student->signature }}`)
              // const eSig1 = await pdfDoc.embedPng(sig1);
              // form.getTextField('Text43').setImage(eSig1);


              @if (array_key_exists(1, $group->groupMembers->toArray()))
                  form.getTextField('STUDENT 2').setText(`{{ $group->groupMembers[1]->student->name }}`)
                  form.getTextField('STUDENT 2_2').setText(`{{ $group->groupMembers[1]->student->name }}`)
              //     form.getTextField('Text35').setText(`{{ $group->groupMembers[1]->student->number }}`)
              //     form.getTextField('Text38').setText(`{{ $group->groupMembers[1]->student->course }}`)
              //     form.getTextField('Text41').setText(``)
              //     const sig2 = await getSignature(`/storage/{{ $group->groupMembers[1]->student->signature }}`)
              //     const eSig2 = await pdfDoc.embedPng(sig2);
              //     form.getTextField('Text44').setImage(eSig2);
              @else
                  form.getTextField('STUDENT 2').setText(``)

                  form.getTextField('STUDENT 2_2').setText(``)
              //     form.getTextField('Text35').setText(``)
              //     form.getTextField('Text38').setText(``)
              //     form.getTextField('Text41').setText(``)
              //     form.getTextField('Text44').setText(``)
              @endif

              @if (array_key_exists(2, $group->groupMembers->toArray()))
                  form.getTextField('STUDENT 3').setText(`{{ $group->groupMembers[2]->student->name }}`)
                  form.getTextField('STUDENT 3_2').setText(`{{ $group->groupMembers[2]->student->name }}`)
              //     form.getTextField('Text36').setText(`{{ $group->groupMembers[2]->student->number }}`)
              //     form.getTextField('Text39').setText(`{{ $group->groupMembers[2]->student->course }}`)
              //     form.getTextField('Text42').setText(``)
              //     const sig3 = await getSignature(`/storage/{{ $group->groupMembers[2]->student->signature }}`)
              //     const eSig3 = await pdfDoc.embedPng(sig3);
              //     form.getTextField('Text45').setImage(eSig3);
              @else
                  form.getTextField('STUDENT 3').setText(``)
                  form.getTextField('STUDENT 3_2').setText(``)
              //     form.getTextField('Text36').setText(``)
              //     form.getTextField('Text39').setText(``)
              //     form.getTextField('Text42').setText(``)
              //     form.getTextField('Text45').setText(``)
              @endif

              form.getTextField('For redefense').setText(``)
              // // PANELIST
              form.getTextField('ADVISER').setText(`{{$group->panellists()->whereType('Adviser')->first()->faculty->name}}`)
              form.getTextField('ADVISER_2').setText(`{{$group->panellists()->whereType('Adviser')->first()->faculty->name}}`)
              form.getTextField('PANEL MEMBER 1').setText(`{{$group->panellists()->whereType('Adviser')->first()->faculty->name}}`)
              // form.getTextField('Text46').setText(`{{$group->panellists()->whereType('Adviser')->first()->faculty->name}}`)
              // form.getTextField('Text53').setText(``) // relevant degree
              // form.getTextField('Text47').setText(``) // relevant degree
              // form.getTextField('Text60').setText(``) // date
              // form.getTextField('Text49').setText(``) // date
              // @if($group->panellists()->whereType('Adviser')->first()->faculty->signature)
              //   const p1 = await getSignature(`/storage/{{ $group->panellists()->whereType('Adviser')->first()->faculty->signature }}`)
              //   const ep1 = await pdfDoc.embedPng(p1);
              //   form.getTextField('Signature58_es_:signer:signature').setImage(ep1)
              //   form.getTextField('Signature48_es_:signer:signature').setImage(ep1)
              // @else

              // form.getTextField('Signature58_es_:signer:signature').setText('')
              // form.getTextField('Signature48_es_:signer:signature').setText('')
              // @endif

              form.getTextField('PANEL CHAIR').setText(`{{$group->panellists()->whereType('Chair')->first()->faculty->name}}`)
              form.getTextField('PANEL MEMBER 2').setText(`{{$group->panellists()->whereType('Chair')->first()->faculty->name}}`)
              // form.getTextField('Text54').setText(``) // relevant degree
              // form.getTextField('Text61').setText(``) // date
              // @if($group->panellists()->whereType('Chair')->first()->faculty->signature)
              //   const p1 = await getSignature(`/storage/{{ $group->panellists()->whereType('Chair')->first()->faculty->signature }}`)
              //   const ep1 = await pdfDoc.embedPng(p1);
              //   form.getTextField('Signature57_es_:signer:signature').setImage(ep1)
              // @else
              // form.getTextField('Signature57_es_:signer:signature').setText('')
              // @endif

              form.getTextField('PANEL MEMBER').setText(`{{$group->panellists()->whereType('Member')->first()->faculty->name}}`)
              form.getTextField('PANEL MEMBER 3').setText(`{{$group->panellists()->whereType('Member')->first()->faculty->name}}`)
              // form.getTextField('Text55').setText(``) // relevant degree
              // form.getTextField('Text62').setText(``) // date
              // @if($group->panellists()->whereType('Member')->first()->faculty->signature)
              //   const p1 = await getSignature(`/storage/{{ $group->panellists()->whereType('Member')->first()->faculty->signature }}`)
              //   const ep1 = await pdfDoc.embedPng(p1);
              //   form.getTextField('Signature59_es_:signer:signature').setImage(ep1)
              // @else
              // form.getTextField('Signature59_es_:signer:signature').setText('')
              // @endif

              form.getTextField('Text42').setText("{{implode('\n', $group->revisions->map(fn ($e) => '- '.$e->revision)->take(8 - count($group->revisions))->toArray())}}") // other revisions
              form.getTextField('COURSE COORDINATOR').setText('{{\App\Models\User::find(nova_get_setting("coordinator_id", 1))->name}}')
              form.getTextField('COURSE COORDINATOR_2').setText('{{\App\Models\User::find(nova_get_setting("coordinator_id", 1))->name}}')
              form.getTextField('PROGRAM CHAIR').setText('{{\App\Models\User::find(nova_get_setting("programchair_id", 1))->name}}')
              // form.getTextField('Text64').setText('{{\App\Models\User::whereType("Dean")->first()->name}}')

              // // CHECKBOX

              @if ($group->title->ic_type == 'Thesis')
                  let fielda = form.getTextField('THESIS')
                    fielda.setFontSize(16)
                    fielda.setText('*')
              @else
                form.getTextField('THESIS').setText('')
              @endif

              @if ($group->title->ic_type == 'Capstone')
                let fieldb = form.getTextField('CAPSTONE PROJECT')
                    fieldb.setFontSize(16)
                    fieldb.setText('*')
              @else
                form.getTextField('CAPSTONE PROJECT').setText('')
              @endif

              @if ($group->title->ic_type == 'Feasibility Study')
                let fieldc = form.getTextField('FEASIBILITY STUDY')
                    fieldc.setFontSize(16)
                    fieldc.setText('*')
              @else
                form.getTextField('FEASIBILITY STUDY').setText('')
              @endif

              @if ($group->title->ic_type == 'Plant Design')
                let fieldd = form.getTextField('PLANT DESIGN')
                    fieldd.setFontSize(16)
                    fieldd.setText('*')
              @else
                form.getTextField('PLANT DESIGN').setText('')
              @endif

              @if ($group->title->ic_type == 'Business Plan')
                let fielde = form.getTextField('BUSINESS PLAN')
                    fielde.setFontSize(16)
                    fielde.setText('*')
              @else
                form.getTextField('BUSINESS PLAN').setText('')
              @endif
              @if ($group->title->section->course->thesis_phase == 'Proposal')
                let fieldf = form.getTextField('undefined')
                    fieldf.setFontSize(16)
                    fieldf.setText('*')
              @else
                form.getTextField('undefined').setText('')
              @endif

              @if ($group->title->section->course->thesis_phase == 'Final')
                let fieldx = form.getTextField('PROPOSAL DEFENSE')
                    fieldx.setFontSize(16)
                    fieldx.setText('*')
              @else
                form.getTextField('PROPOSAL DEFENSE').setText('')
              @endif


              // @if ($group->title->section->thesis_phase == 'Final')
              //     form.getCheckBox('Check Box30').check();
              // @endif




              form.flatten();
              const pdfDataUri = await pdfDoc.saveAsBase64({
                  dataUri: true
              });
              document.getElementById('pdf').src = pdfDataUri;
          }
      </script>
  @endif
</x-form>

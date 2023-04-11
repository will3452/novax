<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            [
                "image"=> "http=>//dummyimage.com/249x100.png/ff4444/ffffff",
                "name"=> "pede",
                "code"=> "punch",
                "description"=> "Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/155x100.png/dddddd/000000",
                "name"=> "id mauris",
                "code"=> "blued",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/120x100.png/cc0000/ffffff",
                "name"=> "morbi vestibulum velit",
                "code"=> "savor",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/228x100.png/cc0000/ffffff",
                "name"=> "aliquam erat",
                "code"=> "vexed",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/221x100.png/cc0000/ffffff",
                "name"=> "semper",
                "code"=> "donor",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.\n\nMorbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/121x100.png/dddddd/000000",
                "name"=> "rhoncus sed vestibulum",
                "code"=> "lab's",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.\n\nMaecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/240x100.png/5fa2dd/ffffff",
                "name"=> "leo pellentesque",
                "code"=> "whets",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/163x100.png/5fa2dd/ffffff",
                "name"=> "eu est congue",
                "code"=> "hound",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/212x100.png/dddddd/000000",
                "name"=> "sapien cursus vestibulum",
                "code"=> "bombs",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/182x100.png/cc0000/ffffff",
                "name"=> "eu",
                "code"=> "prone",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/242x100.png/ff4444/ffffff",
                "name"=> "lobortis convallis tortor",
                "code"=> "peals",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/165x100.png/dddddd/000000",
                "name"=> "parturient montes",
                "code"=> "revue",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/148x100.png/ff4444/ffffff",
                "name"=> "massa",
                "code"=> "fared",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/236x100.png/dddddd/000000",
                "name"=> "elementum",
                "code"=> "vasts",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.\n\nFusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/126x100.png/ff4444/ffffff",
                "name"=> "velit donec diam",
                "code"=> "hat's",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/cc0000/ffffff",
                "name"=> "nisi",
                "code"=> "feign",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.\n\nMorbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/207x100.png/5fa2dd/ffffff",
                "name"=> "libero",
                "code"=> "gnarl",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.\n\nCras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/138x100.png/5fa2dd/ffffff",
                "name"=> "nonummy maecenas tincidunt",
                "code"=> "grind",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/151x100.png/5fa2dd/ffffff",
                "name"=> "id",
                "code"=> "exile",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/102x100.png/ff4444/ffffff",
                "name"=> "ipsum primis",
                "code"=> "speed",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/175x100.png/5fa2dd/ffffff",
                "name"=> "felis",
                "code"=> "pupil",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/104x100.png/dddddd/000000",
                "name"=> "lobortis ligula sit",
                "code"=> "words",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/142x100.png/dddddd/000000",
                "name"=> "massa id",
                "code"=> "peril",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.\n\nQuisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/126x100.png/dddddd/000000",
                "name"=> "volutpat dui maecenas",
                "code"=> "wrapt",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/190x100.png/dddddd/000000",
                "name"=> "curabitur",
                "code"=> "ghoul",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/243x100.png/ff4444/ffffff",
                "name"=> "pretium iaculis",
                "code"=> "trues",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/184x100.png/dddddd/000000",
                "name"=> "tincidunt",
                "code"=> "icing",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.\n\nQuisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/153x100.png/dddddd/000000",
                "name"=> "vivamus",
                "code"=> "joy's",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/198x100.png/ff4444/ffffff",
                "name"=> "enim in",
                "code"=> "domed",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.\n\nInteger tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/cc0000/ffffff",
                "name"=> "turpis",
                "code"=> "comic",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/185x100.png/ff4444/ffffff",
                "name"=> "massa",
                "code"=> "agree",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/146x100.png/dddddd/000000",
                "name"=> "varius ut blandit",
                "code"=> "lease",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/184x100.png/ff4444/ffffff",
                "name"=> "lorem id",
                "code"=> "crook",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/151x100.png/cc0000/ffffff",
                "name"=> "interdum",
                "code"=> "era's",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/165x100.png/ff4444/ffffff",
                "name"=> "in faucibus orci",
                "code"=> "goody",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/123x100.png/dddddd/000000",
                "name"=> "dui maecenas tristique",
                "code"=> "sonic",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/129x100.png/ff4444/ffffff",
                "name"=> "lectus",
                "code"=> "hosed",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/199x100.png/ff4444/ffffff",
                "name"=> "turpis",
                "code"=> "trash",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/178x100.png/dddddd/000000",
                "name"=> "dui nec nisi",
                "code"=> "cards",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/172x100.png/dddddd/000000",
                "name"=> "sapien non mi",
                "code"=> "taken",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/175x100.png/cc0000/ffffff",
                "name"=> "turpis a",
                "code"=> "cinch",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.\n\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/117x100.png/cc0000/ffffff",
                "name"=> "justo in",
                "code"=> "inked",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/237x100.png/dddddd/000000",
                "name"=> "augue",
                "code"=> "ivies",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/219x100.png/ff4444/ffffff",
                "name"=> "duis bibendum",
                "code"=> "links",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/236x100.png/ff4444/ffffff",
                "name"=> "ipsum dolor",
                "code"=> "cod's",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.\n\nVestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/185x100.png/dddddd/000000",
                "name"=> "at velit",
                "code"=> "empty",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/243x100.png/ff4444/ffffff",
                "name"=> "porta volutpat quam",
                "code"=> "proud",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/247x100.png/5fa2dd/ffffff",
                "name"=> "euismod",
                "code"=> "sexes",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/188x100.png/cc0000/ffffff",
                "name"=> "justo maecenas",
                "code"=> "froze",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.\n\nMaecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/230x100.png/dddddd/000000",
                "name"=> "nascetur ridiculus mus",
                "code"=> "mushy",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/155x100.png/cc0000/ffffff",
                "name"=> "molestie nibh in",
                "code"=> "ailed",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.\n\nProin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/130x100.png/dddddd/000000",
                "name"=> "scelerisque mauris sit",
                "code"=> "tames",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/162x100.png/dddddd/000000",
                "name"=> "nullam orci pede",
                "code"=> "flake",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/171x100.png/cc0000/ffffff",
                "name"=> "in lacus",
                "code"=> "peeks",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.\n\nMaecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/112x100.png/dddddd/000000",
                "name"=> "ultrices enim lorem",
                "code"=> "chili",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/224x100.png/ff4444/ffffff",
                "name"=> "sapien urna",
                "code"=> "perky",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/222x100.png/cc0000/ffffff",
                "name"=> "justo sit",
                "code"=> "tipsy",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/146x100.png/5fa2dd/ffffff",
                "name"=> "praesent",
                "code"=> "ached",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/179x100.png/5fa2dd/ffffff",
                "name"=> "lacus curabitur at",
                "code"=> "lemon",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.\n\nNam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/240x100.png/dddddd/000000",
                "name"=> "felis eu",
                "code"=> "glues",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.\n\nCras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/246x100.png/dddddd/000000",
                "name"=> "maecenas leo odio",
                "code"=> "ape's",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/105x100.png/ff4444/ffffff",
                "name"=> "dapibus",
                "code"=> "axe's",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.\n\nAenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/141x100.png/ff4444/ffffff",
                "name"=> "tortor eu pede",
                "code"=> "ebb's",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/211x100.png/5fa2dd/ffffff",
                "name"=> "mauris viverra diam",
                "code"=> "rot's",
                "description"=> "Sed ante. Vivamus tortor. Duis mattis egestas metus.\n\nAenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/194x100.png/5fa2dd/ffffff",
                "name"=> "ipsum aliquam",
                "code"=> "grays",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/119x100.png/dddddd/000000",
                "name"=> "neque sapien placerat",
                "code"=> "sheer",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/159x100.png/5fa2dd/ffffff",
                "name"=> "at lorem",
                "code"=> "rumps",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.\n\nProin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/114x100.png/ff4444/ffffff",
                "name"=> "vel ipsum praesent",
                "code"=> "aye's",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/224x100.png/5fa2dd/ffffff",
                "name"=> "nec nisi volutpat",
                "code"=> "queer",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/137x100.png/ff4444/ffffff",
                "name"=> "ultrices",
                "code"=> "bumps",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/205x100.png/5fa2dd/ffffff",
                "name"=> "at",
                "code"=> "eaten",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/100x100.png/dddddd/000000",
                "name"=> "dolor sit amet",
                "code"=> "charm",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/126x100.png/cc0000/ffffff",
                "name"=> "sed",
                "code"=> "koala",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/167x100.png/5fa2dd/ffffff",
                "name"=> "nisl",
                "code"=> "repay",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/125x100.png/5fa2dd/ffffff",
                "name"=> "tortor",
                "code"=> "job's",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.\n\nCurabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/103x100.png/dddddd/000000",
                "name"=> "euismod scelerisque",
                "code"=> "omens",
                "description"=> "Sed ante. Vivamus tortor. Duis mattis egestas metus.\n\nAenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/132x100.png/5fa2dd/ffffff",
                "name"=> "convallis",
                "code"=> "blurt",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/219x100.png/cc0000/ffffff",
                "name"=> "id turpis",
                "code"=> "dogma",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/139x100.png/5fa2dd/ffffff",
                "name"=> "neque",
                "code"=> "rowdy",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\n\nEtiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/243x100.png/5fa2dd/ffffff",
                "name"=> "nisi",
                "code"=> "birth",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/199x100.png/ff4444/ffffff",
                "name"=> "augue",
                "code"=> "appal",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/165x100.png/cc0000/ffffff",
                "name"=> "cursus",
                "code"=> "diner",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/220x100.png/cc0000/ffffff",
                "name"=> "mauris vulputate elementum",
                "code"=> "tunic",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/158x100.png/cc0000/ffffff",
                "name"=> "vivamus tortor duis",
                "code"=> "lures",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/247x100.png/5fa2dd/ffffff",
                "name"=> "tincidunt eu",
                "code"=> "amply",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/102x100.png/dddddd/000000",
                "name"=> "condimentum curabitur",
                "code"=> "shy's",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/168x100.png/ff4444/ffffff",
                "name"=> "ornare consequat",
                "code"=> "foist",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/237x100.png/ff4444/ffffff",
                "name"=> "tempus",
                "code"=> "we're",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/142x100.png/ff4444/ffffff",
                "name"=> "eget tincidunt eget",
                "code"=> "runes",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/140x100.png/dddddd/000000",
                "name"=> "sapien varius",
                "code"=> "salts",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.\n\nIn congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/197x100.png/5fa2dd/ffffff",
                "name"=> "porta volutpat erat",
                "code"=> "robot",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/165x100.png/ff4444/ffffff",
                "name"=> "morbi quis",
                "code"=> "buddy",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/187x100.png/ff4444/ffffff",
                "name"=> "nibh ligula",
                "code"=> "beaks",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/174x100.png/ff4444/ffffff",
                "name"=> "tortor duis",
                "code"=> "hotly",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/145x100.png/cc0000/ffffff",
                "name"=> "odio consequat",
                "code"=> "scums",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/243x100.png/dddddd/000000",
                "name"=> "rutrum nulla",
                "code"=> "quits",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/163x100.png/ff4444/ffffff",
                "name"=> "nam tristique",
                "code"=> "boars",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/129x100.png/dddddd/000000",
                "name"=> "nunc commodo",
                "code"=> "guppy",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/158x100.png/dddddd/000000",
                "name"=> "nibh ligula nec",
                "code"=> "teams",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/187x100.png/cc0000/ffffff",
                "name"=> "iaculis",
                "code"=> "celli",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/130x100.png/5fa2dd/ffffff",
                "name"=> "amet",
                "code"=> "flirt",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.\n\nMaecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/140x100.png/5fa2dd/ffffff",
                "name"=> "est quam pharetra",
                "code"=> "czars",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.\n\nPellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/232x100.png/cc0000/ffffff",
                "name"=> "lectus aliquam",
                "code"=> "silks",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/128x100.png/ff4444/ffffff",
                "name"=> "justo eu massa",
                "code"=> "frays",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/171x100.png/5fa2dd/ffffff",
                "name"=> "viverra dapibus nulla",
                "code"=> "tulip",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.\n\nPraesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/115x100.png/ff4444/ffffff",
                "name"=> "aenean sit amet",
                "code"=> "bless",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/154x100.png/cc0000/ffffff",
                "name"=> "id ornare imperdiet",
                "code"=> "acrid",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/235x100.png/ff4444/ffffff",
                "name"=> "congue",
                "code"=> "holly",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/184x100.png/ff4444/ffffff",
                "name"=> "non velit nec",
                "code"=> "plaza",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/208x100.png/5fa2dd/ffffff",
                "name"=> "non",
                "code"=> "calve",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/5fa2dd/ffffff",
                "name"=> "sagittis sapien cum",
                "code"=> "knobs",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/102x100.png/5fa2dd/ffffff",
                "name"=> "metus",
                "code"=> "liter",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/248x100.png/dddddd/000000",
                "name"=> "orci",
                "code"=> "tasks",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/244x100.png/dddddd/000000",
                "name"=> "proin at",
                "code"=> "sixth",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.\n\nPellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/250x100.png/dddddd/000000",
                "name"=> "lobortis ligula",
                "code"=> "inlay",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/221x100.png/ff4444/ffffff",
                "name"=> "magnis dis parturient",
                "code"=> "shunt",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/104x100.png/ff4444/ffffff",
                "name"=> "amet nulla quisque",
                "code"=> "sight",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/230x100.png/5fa2dd/ffffff",
                "name"=> "cras",
                "code"=> "clans",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/153x100.png/5fa2dd/ffffff",
                "name"=> "nulla ultrices",
                "code"=> "brace",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/232x100.png/dddddd/000000",
                "name"=> "ac",
                "code"=> "brown",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/175x100.png/ff4444/ffffff",
                "name"=> "viverra",
                "code"=> "greys",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/116x100.png/cc0000/ffffff",
                "name"=> "lorem id",
                "code"=> "wears",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/115x100.png/5fa2dd/ffffff",
                "name"=> "nunc donec",
                "code"=> "codes",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/227x100.png/dddddd/000000",
                "name"=> "tempus vel pede",
                "code"=> "clack",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/164x100.png/cc0000/ffffff",
                "name"=> "hac habitasse platea",
                "code"=> "punks",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/223x100.png/cc0000/ffffff",
                "name"=> "vestibulum",
                "code"=> "shrug",
                "description"=> "Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/130x100.png/cc0000/ffffff",
                "name"=> "dolor",
                "code"=> "ledge",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/111x100.png/cc0000/ffffff",
                "name"=> "tortor",
                "code"=> "gaudy",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/148x100.png/cc0000/ffffff",
                "name"=> "sit amet",
                "code"=> "banjo",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/133x100.png/5fa2dd/ffffff",
                "name"=> "cras pellentesque volutpat",
                "code"=> "elect",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/193x100.png/dddddd/000000",
                "name"=> "sit amet",
                "code"=> "crate",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/102x100.png/ff4444/ffffff",
                "name"=> "amet",
                "code"=> "floor",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/131x100.png/cc0000/ffffff",
                "name"=> "id lobortis",
                "code"=> "hip's",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/105x100.png/dddddd/000000",
                "name"=> "vel ipsum praesent",
                "code"=> "curds",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/141x100.png/ff4444/ffffff",
                "name"=> "dui proin",
                "code"=> "flame",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/141x100.png/5fa2dd/ffffff",
                "name"=> "tortor",
                "code"=> "octal",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.\n\nNam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/129x100.png/5fa2dd/ffffff",
                "name"=> "ut massa",
                "code"=> "frank",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/119x100.png/dddddd/000000",
                "name"=> "odio consequat varius",
                "code"=> "quail",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/166x100.png/5fa2dd/ffffff",
                "name"=> "interdum",
                "code"=> "jolly",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/178x100.png/ff4444/ffffff",
                "name"=> "ut blandit",
                "code"=> "shock",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/150x100.png/5fa2dd/ffffff",
                "name"=> "parturient montes nascetur",
                "code"=> "IRS's",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/164x100.png/cc0000/ffffff",
                "name"=> "adipiscing lorem",
                "code"=> "belts",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.\n\nSuspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/200x100.png/ff4444/ffffff",
                "name"=> "augue vestibulum ante",
                "code"=> "truer",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\n\nEtiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/102x100.png/5fa2dd/ffffff",
                "name"=> "nisi vulputate nonummy",
                "code"=> "gamma",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/110x100.png/cc0000/ffffff",
                "name"=> "ut nulla sed",
                "code"=> "reads",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/144x100.png/dddddd/000000",
                "name"=> "mauris enim",
                "code"=> "pokes",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/102x100.png/dddddd/000000",
                "name"=> "lectus",
                "code"=> "tunic",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/207x100.png/ff4444/ffffff",
                "name"=> "curabitur",
                "code"=> "axiom",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/249x100.png/cc0000/ffffff",
                "name"=> "accumsan odio curabitur",
                "code"=> "tunic",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.\n\nMaecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/122x100.png/dddddd/000000",
                "name"=> "erat eros viverra",
                "code"=> "haunt",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/104x100.png/cc0000/ffffff",
                "name"=> "ipsum",
                "code"=> "lease",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.\n\nVestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/179x100.png/5fa2dd/ffffff",
                "name"=> "platea",
                "code"=> "butts",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/158x100.png/dddddd/000000",
                "name"=> "velit",
                "code"=> "labor",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/dddddd/000000",
                "name"=> "faucibus orci",
                "code"=> "smock",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.\n\nMaecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/145x100.png/cc0000/ffffff",
                "name"=> "semper sapien a",
                "code"=> "night",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.\n\nMorbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/160x100.png/ff4444/ffffff",
                "name"=> "mauris laoreet ut",
                "code"=> "owned",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.\n\nVestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/160x100.png/ff4444/ffffff",
                "name"=> "nec nisi vulputate",
                "code"=> "basks",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.\n\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/168x100.png/5fa2dd/ffffff",
                "name"=> "sit amet eleifend",
                "code"=> "siege",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/200x100.png/5fa2dd/ffffff",
                "name"=> "vestibulum velit",
                "code"=> "birth",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/103x100.png/dddddd/000000",
                "name"=> "nunc",
                "code"=> "spill",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/245x100.png/cc0000/ffffff",
                "name"=> "lectus pellentesque",
                "code"=> "swish",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/190x100.png/ff4444/ffffff",
                "name"=> "dui vel",
                "code"=> "worry",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/183x100.png/5fa2dd/ffffff",
                "name"=> "at feugiat non",
                "code"=> "quirk",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/194x100.png/cc0000/ffffff",
                "name"=> "vitae consectetuer",
                "code"=> "pushy",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/cc0000/ffffff",
                "name"=> "ipsum praesent blandit",
                "code"=> "swung",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/151x100.png/dddddd/000000",
                "name"=> "quam a odio",
                "code"=> "chars",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/145x100.png/dddddd/000000",
                "name"=> "pede ullamcorper augue",
                "code"=> "weedy",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/175x100.png/dddddd/000000",
                "name"=> "at nulla suspendisse",
                "code"=> "grasp",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/238x100.png/dddddd/000000",
                "name"=> "nibh ligula nec",
                "code"=> "boots",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.\n\nCurabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/103x100.png/dddddd/000000",
                "name"=> "sapien arcu",
                "code"=> "hills",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/124x100.png/cc0000/ffffff",
                "name"=> "fusce",
                "code"=> "baron",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/189x100.png/5fa2dd/ffffff",
                "name"=> "erat id",
                "code"=> "wag's",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/233x100.png/5fa2dd/ffffff",
                "name"=> "congue elementum in",
                "code"=> "jumbo",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/143x100.png/dddddd/000000",
                "name"=> "ante ipsum primis",
                "code"=> "ply's",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/195x100.png/dddddd/000000",
                "name"=> "vel",
                "code"=> "roofs",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/105x100.png/ff4444/ffffff",
                "name"=> "sapien urna",
                "code"=> "tramp",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/222x100.png/dddddd/000000",
                "name"=> "erat tortor",
                "code"=> "togae",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/133x100.png/5fa2dd/ffffff",
                "name"=> "sit amet",
                "code"=> "chirp",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/202x100.png/5fa2dd/ffffff",
                "name"=> "ridiculus mus etiam",
                "code"=> "kinky",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/101x100.png/5fa2dd/ffffff",
                "name"=> "orci luctus et",
                "code"=> "quirk",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/ff4444/ffffff",
                "name"=> "eros vestibulum ac",
                "code"=> "heats",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\n\nEtiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/231x100.png/cc0000/ffffff",
                "name"=> "quis justo maecenas",
                "code"=> "party",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/183x100.png/cc0000/ffffff",
                "name"=> "donec pharetra",
                "code"=> "jog's",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.\n\nProin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/223x100.png/5fa2dd/ffffff",
                "name"=> "nullam molestie nibh",
                "code"=> "newts",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.\n\nInteger tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/197x100.png/ff4444/ffffff",
                "name"=> "consectetuer adipiscing elit",
                "code"=> "laded",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/140x100.png/5fa2dd/ffffff",
                "name"=> "enim",
                "code"=> "jolts",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/221x100.png/dddddd/000000",
                "name"=> "ultrices",
                "code"=> "hoe's",
                "description"=> "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.\n\nIn sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/149x100.png/ff4444/ffffff",
                "name"=> "nec",
                "code"=> "spunk",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/5fa2dd/ffffff",
                "name"=> "orci",
                "code"=> "gruff",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.\n\nFusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/174x100.png/5fa2dd/ffffff",
                "name"=> "elit proin",
                "code"=> "ogled",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.\n\nIn congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/170x100.png/ff4444/ffffff",
                "name"=> "non pretium",
                "code"=> "leave",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/153x100.png/dddddd/000000",
                "name"=> "vivamus vel",
                "code"=> "bunch",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/190x100.png/dddddd/000000",
                "name"=> "ullamcorper purus sit",
                "code"=> "bulls",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/180x100.png/ff4444/ffffff",
                "name"=> "ut",
                "code"=> "teems",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/239x100.png/cc0000/ffffff",
                "name"=> "semper",
                "code"=> "prune",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.\n\nFusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/107x100.png/5fa2dd/ffffff",
                "name"=> "vehicula condimentum curabitur",
                "code"=> "pager",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.\n\nMaecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/193x100.png/ff4444/ffffff",
                "name"=> "ac consequat metus",
                "code"=> "rifer",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.\n\nMauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/111x100.png/5fa2dd/ffffff",
                "name"=> "augue luctus tincidunt",
                "code"=> "slate",
                "description"=> "Sed ante. Vivamus tortor. Duis mattis egestas metus.\n\nAenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/138x100.png/dddddd/000000",
                "name"=> "tincidunt in",
                "code"=> "reels",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/168x100.png/cc0000/ffffff",
                "name"=> "cubilia curae",
                "code"=> "oiled",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/164x100.png/ff4444/ffffff",
                "name"=> "convallis eget eleifend",
                "code"=> "wrist",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/196x100.png/dddddd/000000",
                "name"=> "mattis nibh",
                "code"=> "cults",
                "description"=> "Sed ante. Vivamus tortor. Duis mattis egestas metus.\n\nAenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/132x100.png/5fa2dd/ffffff",
                "name"=> "lectus pellentesque",
                "code"=> "ceded",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/160x100.png/cc0000/ffffff",
                "name"=> "tortor id",
                "code"=> "count",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/175x100.png/5fa2dd/ffffff",
                "name"=> "ultrices",
                "code"=> "noses",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/138x100.png/cc0000/ffffff",
                "name"=> "ipsum aliquam",
                "code"=> "impel",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/201x100.png/5fa2dd/ffffff",
                "name"=> "volutpat",
                "code"=> "greys",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/159x100.png/cc0000/ffffff",
                "name"=> "eu pede",
                "code"=> "punts",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/154x100.png/cc0000/ffffff",
                "name"=> "turpis integer",
                "code"=> "gowns",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.\n\nProin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/146x100.png/5fa2dd/ffffff",
                "name"=> "sit amet",
                "code"=> "sum's",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/228x100.png/ff4444/ffffff",
                "name"=> "ligula suspendisse ornare",
                "code"=> "gouge",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/155x100.png/cc0000/ffffff",
                "name"=> "mi",
                "code"=> "annul",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.\n\nVestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/180x100.png/5fa2dd/ffffff",
                "name"=> "suscipit",
                "code"=> "peons",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.\n\nInteger tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/181x100.png/ff4444/ffffff",
                "name"=> "metus",
                "code"=> "awing",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/188x100.png/ff4444/ffffff",
                "name"=> "vestibulum vestibulum ante",
                "code"=> "zests",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/222x100.png/5fa2dd/ffffff",
                "name"=> "justo eu",
                "code"=> "suits",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/138x100.png/5fa2dd/ffffff",
                "name"=> "accumsan",
                "code"=> "ark's",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.\n\nProin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/238x100.png/5fa2dd/ffffff",
                "name"=> "sit amet",
                "code"=> "cysts",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.\n\nIn congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/ff4444/ffffff",
                "name"=> "platea dictumst",
                "code"=> "lynch",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/160x100.png/cc0000/ffffff",
                "name"=> "quisque porta volutpat",
                "code"=> "plate",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/135x100.png/ff4444/ffffff",
                "name"=> "etiam vel augue",
                "code"=> "hates",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/249x100.png/cc0000/ffffff",
                "name"=> "integer non velit",
                "code"=> "deign",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/217x100.png/dddddd/000000",
                "name"=> "ut",
                "code"=> "elder",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/166x100.png/cc0000/ffffff",
                "name"=> "mus",
                "code"=> "rowdy",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/152x100.png/dddddd/000000",
                "name"=> "tortor eu",
                "code"=> "sadly",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.\n\nSuspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/187x100.png/ff4444/ffffff",
                "name"=> "tempus vel pede",
                "code"=> "clack",
                "description"=> "Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/202x100.png/5fa2dd/ffffff",
                "name"=> "eleifend luctus ultricies",
                "code"=> "signs",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.\n\nMaecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/134x100.png/dddddd/000000",
                "name"=> "sem",
                "code"=> "elope",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/125x100.png/dddddd/000000",
                "name"=> "consequat dui",
                "code"=> "froze",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/146x100.png/cc0000/ffffff",
                "name"=> "in consequat",
                "code"=> "wooly",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/153x100.png/5fa2dd/ffffff",
                "name"=> "amet sapien dignissim",
                "code"=> "range",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/174x100.png/dddddd/000000",
                "name"=> "faucibus accumsan",
                "code"=> "punts",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/154x100.png/dddddd/000000",
                "name"=> "magna",
                "code"=> "dally",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.\n\nProin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/139x100.png/cc0000/ffffff",
                "name"=> "quis turpis eget",
                "code"=> "lorry",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/196x100.png/cc0000/ffffff",
                "name"=> "euismod scelerisque",
                "code"=> "seven",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.\n\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/159x100.png/cc0000/ffffff",
                "name"=> "id nisl",
                "code"=> "funny",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/108x100.png/5fa2dd/ffffff",
                "name"=> "fermentum donec",
                "code"=> "coped",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/239x100.png/dddddd/000000",
                "name"=> "at nulla suspendisse",
                "code"=> "usher",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/130x100.png/dddddd/000000",
                "name"=> "tellus",
                "code"=> "liter",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/dddddd/000000",
                "name"=> "praesent lectus vestibulum",
                "code"=> "biked",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/124x100.png/cc0000/ffffff",
                "name"=> "ante vel ipsum",
                "code"=> "disco",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/181x100.png/dddddd/000000",
                "name"=> "proin at",
                "code"=> "goody",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/190x100.png/5fa2dd/ffffff",
                "name"=> "integer ac leo",
                "code"=> "cites",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/190x100.png/dddddd/000000",
                "name"=> "vestibulum proin eu",
                "code"=> "chaos",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/226x100.png/cc0000/ffffff",
                "name"=> "massa id lobortis",
                "code"=> "press",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/110x100.png/dddddd/000000",
                "name"=> "phasellus id",
                "code"=> "soaps",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/194x100.png/cc0000/ffffff",
                "name"=> "tellus in",
                "code"=> "law's",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/219x100.png/ff4444/ffffff",
                "name"=> "faucibus orci luctus",
                "code"=> "gully",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/133x100.png/5fa2dd/ffffff",
                "name"=> "rutrum",
                "code"=> "slips",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/185x100.png/5fa2dd/ffffff",
                "name"=> "dictumst",
                "code"=> "cod's",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/229x100.png/5fa2dd/ffffff",
                "name"=> "viverra dapibus",
                "code"=> "pumas",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/164x100.png/dddddd/000000",
                "name"=> "ante",
                "code"=> "jokes",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/144x100.png/5fa2dd/ffffff",
                "name"=> "libero",
                "code"=> "mange",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/122x100.png/dddddd/000000",
                "name"=> "sed magna at",
                "code"=> "fogey",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/134x100.png/ff4444/ffffff",
                "name"=> "venenatis turpis enim",
                "code"=> "blink",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.\n\nQuisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/196x100.png/ff4444/ffffff",
                "name"=> "iaculis",
                "code"=> "gooey",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/162x100.png/cc0000/ffffff",
                "name"=> "gravida sem praesent",
                "code"=> "float",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.\n\nVestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/197x100.png/cc0000/ffffff",
                "name"=> "blandit nam",
                "code"=> "aimed",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/165x100.png/ff4444/ffffff",
                "name"=> "egestas metus aenean",
                "code"=> "opera",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.\n\nMorbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/194x100.png/ff4444/ffffff",
                "name"=> "viverra diam",
                "code"=> "yearn",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/206x100.png/ff4444/ffffff",
                "name"=> "vulputate vitae",
                "code"=> "forty",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/190x100.png/cc0000/ffffff",
                "name"=> "proin",
                "code"=> "momma",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/174x100.png/cc0000/ffffff",
                "name"=> "nisi at",
                "code"=> "guide",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/196x100.png/ff4444/ffffff",
                "name"=> "volutpat eleifend",
                "code"=> "dizzy",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/194x100.png/cc0000/ffffff",
                "name"=> "phasellus",
                "code"=> "scoff",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/176x100.png/cc0000/ffffff",
                "name"=> "ultricies",
                "code"=> "pulls",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/200x100.png/cc0000/ffffff",
                "name"=> "eu",
                "code"=> "suing",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.\n\nNam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/210x100.png/ff4444/ffffff",
                "name"=> "non quam",
                "code"=> "hairy",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/194x100.png/ff4444/ffffff",
                "name"=> "at",
                "code"=> "pants",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/182x100.png/5fa2dd/ffffff",
                "name"=> "libero non mattis",
                "code"=> "den's",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.\n\nPraesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/125x100.png/cc0000/ffffff",
                "name"=> "aliquam quis turpis",
                "code"=> "pit's",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/119x100.png/dddddd/000000",
                "name"=> "sapien varius ut",
                "code"=> "mover",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/146x100.png/ff4444/ffffff",
                "name"=> "pellentesque volutpat",
                "code"=> "chute",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/161x100.png/dddddd/000000",
                "name"=> "habitasse platea dictumst",
                "code"=> "flaps",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/217x100.png/dddddd/000000",
                "name"=> "dui",
                "code"=> "Greek",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/223x100.png/ff4444/ffffff",
                "name"=> "nam dui proin",
                "code"=> "karat",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/180x100.png/ff4444/ffffff",
                "name"=> "sed",
                "code"=> "flaws",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/5fa2dd/ffffff",
                "name"=> "potenti",
                "code"=> "croci",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/164x100.png/5fa2dd/ffffff",
                "name"=> "non",
                "code"=> "plods",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/178x100.png/dddddd/000000",
                "name"=> "sed interdum",
                "code"=> "flows",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/114x100.png/dddddd/000000",
                "name"=> "magna",
                "code"=> "gob's",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/215x100.png/5fa2dd/ffffff",
                "name"=> "sit amet sem",
                "code"=> "paddy",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/231x100.png/cc0000/ffffff",
                "name"=> "nisl",
                "code"=> "virus",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/197x100.png/ff4444/ffffff",
                "name"=> "sed",
                "code"=> "molar",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/cc0000/ffffff",
                "name"=> "dapibus augue",
                "code"=> "gloat",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/178x100.png/cc0000/ffffff",
                "name"=> "vivamus metus",
                "code"=> "depot",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/135x100.png/5fa2dd/ffffff",
                "name"=> "maecenas ut",
                "code"=> "decay",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/183x100.png/5fa2dd/ffffff",
                "name"=> "cursus id turpis",
                "code"=> "cubed",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/118x100.png/ff4444/ffffff",
                "name"=> "venenatis tristique fusce",
                "code"=> "knows",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/cc0000/ffffff",
                "name"=> "orci",
                "code"=> "death",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/239x100.png/cc0000/ffffff",
                "name"=> "suspendisse potenti nullam",
                "code"=> "would",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/129x100.png/cc0000/ffffff",
                "name"=> "at velit vivamus",
                "code"=> "disco",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/250x100.png/ff4444/ffffff",
                "name"=> "nullam sit",
                "code"=> "vices",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.\n\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/219x100.png/5fa2dd/ffffff",
                "name"=> "turpis eget",
                "code"=> "vault",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/156x100.png/dddddd/000000",
                "name"=> "curabitur gravida",
                "code"=> "peaks",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.\n\nPraesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/171x100.png/5fa2dd/ffffff",
                "name"=> "varius nulla",
                "code"=> "oasis",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/120x100.png/dddddd/000000",
                "name"=> "primis in",
                "code"=> "delis",
                "description"=> "Sed ante. Vivamus tortor. Duis mattis egestas metus.\n\nAenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/125x100.png/cc0000/ffffff",
                "name"=> "auctor gravida",
                "code"=> "ski's",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/142x100.png/dddddd/000000",
                "name"=> "at",
                "code"=> "cycle",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/150x100.png/5fa2dd/ffffff",
                "name"=> "orci",
                "code"=> "champ",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/187x100.png/dddddd/000000",
                "name"=> "sociis natoque penatibus",
                "code"=> "buggy",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/116x100.png/dddddd/000000",
                "name"=> "nunc rhoncus dui",
                "code"=> "aid's",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/220x100.png/ff4444/ffffff",
                "name"=> "eu sapien cursus",
                "code"=> "hobby",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/243x100.png/5fa2dd/ffffff",
                "name"=> "eu massa",
                "code"=> "boded",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/182x100.png/dddddd/000000",
                "name"=> "donec",
                "code"=> "green",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/136x100.png/cc0000/ffffff",
                "name"=> "nonummy integer",
                "code"=> "scarf",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.\n\nInteger tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/241x100.png/ff4444/ffffff",
                "name"=> "nisl aenean lectus",
                "code"=> "caulk",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.\n\nNam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/119x100.png/dddddd/000000",
                "name"=> "iaculis congue vivamus",
                "code"=> "aided",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/222x100.png/dddddd/000000",
                "name"=> "vulputate nonummy",
                "code"=> "loots",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/165x100.png/dddddd/000000",
                "name"=> "condimentum curabitur in",
                "code"=> "fagot",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/240x100.png/5fa2dd/ffffff",
                "name"=> "hac habitasse",
                "code"=> "frond",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/181x100.png/5fa2dd/ffffff",
                "name"=> "pulvinar sed",
                "code"=> "admit",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/148x100.png/dddddd/000000",
                "name"=> "morbi a",
                "code"=> "apter",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/110x100.png/cc0000/ffffff",
                "name"=> "ultrices vel",
                "code"=> "spice",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/206x100.png/ff4444/ffffff",
                "name"=> "eget rutrum at",
                "code"=> "flash",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/247x100.png/ff4444/ffffff",
                "name"=> "viverra",
                "code"=> "slime",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/109x100.png/dddddd/000000",
                "name"=> "nisi",
                "code"=> "belie",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/238x100.png/cc0000/ffffff",
                "name"=> "vel",
                "code"=> "pines",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/134x100.png/5fa2dd/ffffff",
                "name"=> "ut volutpat sapien",
                "code"=> "nurse",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/213x100.png/ff4444/ffffff",
                "name"=> "habitasse",
                "code"=> "party",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/ff4444/ffffff",
                "name"=> "ultrices posuere cubilia",
                "code"=> "meets",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/132x100.png/dddddd/000000",
                "name"=> "tristique est et",
                "code"=> "hay's",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/190x100.png/cc0000/ffffff",
                "name"=> "faucibus accumsan",
                "code"=> "blond",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/5fa2dd/ffffff",
                "name"=> "fusce posuere",
                "code"=> "crave",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/114x100.png/5fa2dd/ffffff",
                "name"=> "eget vulputate ut",
                "code"=> "soars",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.\n\nNam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/101x100.png/dddddd/000000",
                "name"=> "nulla tellus",
                "code"=> "idles",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/198x100.png/ff4444/ffffff",
                "name"=> "consequat",
                "code"=> "shove",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/199x100.png/dddddd/000000",
                "name"=> "elementum in hac",
                "code"=> "goads",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/108x100.png/ff4444/ffffff",
                "name"=> "erat",
                "code"=> "diver",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/145x100.png/dddddd/000000",
                "name"=> "erat tortor sollicitudin",
                "code"=> "farce",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/154x100.png/5fa2dd/ffffff",
                "name"=> "viverra eget",
                "code"=> "dregs",
                "description"=> "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/127x100.png/5fa2dd/ffffff",
                "name"=> "penatibus et magnis",
                "code"=> "sofas",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/188x100.png/5fa2dd/ffffff",
                "name"=> "orci",
                "code"=> "cedes",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.\n\nVestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/159x100.png/dddddd/000000",
                "name"=> "donec pharetra magna",
                "code"=> "junks",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/215x100.png/dddddd/000000",
                "name"=> "praesent",
                "code"=> "nerve",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/115x100.png/dddddd/000000",
                "name"=> "luctus",
                "code"=> "usher",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/111x100.png/cc0000/ffffff",
                "name"=> "in",
                "code"=> "sited",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/189x100.png/dddddd/000000",
                "name"=> "velit id",
                "code"=> "wiz's",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/181x100.png/ff4444/ffffff",
                "name"=> "mi in",
                "code"=> "quash",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/176x100.png/dddddd/000000",
                "name"=> "parturient montes",
                "code"=> "story",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/ff4444/ffffff",
                "name"=> "nullam sit",
                "code"=> "ram's",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/234x100.png/ff4444/ffffff",
                "name"=> "in faucibus orci",
                "code"=> "cares",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/132x100.png/5fa2dd/ffffff",
                "name"=> "eu interdum eu",
                "code"=> "bodes",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/243x100.png/cc0000/ffffff",
                "name"=> "neque",
                "code"=> "dub's",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/231x100.png/5fa2dd/ffffff",
                "name"=> "tristique",
                "code"=> "droop",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/213x100.png/ff4444/ffffff",
                "name"=> "erat tortor sollicitudin",
                "code"=> "tin's",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.\n\nAenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/201x100.png/dddddd/000000",
                "name"=> "viverra eget",
                "code"=> "lanes",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/dddddd/000000",
                "name"=> "aenean fermentum donec",
                "code"=> "mired",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/143x100.png/5fa2dd/ffffff",
                "name"=> "mauris",
                "code"=> "elope",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/140x100.png/cc0000/ffffff",
                "name"=> "accumsan tortor quis",
                "code"=> "sub's",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/174x100.png/ff4444/ffffff",
                "name"=> "mi integer ac",
                "code"=> "vises",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/237x100.png/5fa2dd/ffffff",
                "name"=> "aliquam",
                "code"=> "halos",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/151x100.png/5fa2dd/ffffff",
                "name"=> "platea dictumst",
                "code"=> "muffs",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/110x100.png/dddddd/000000",
                "name"=> "pretium",
                "code"=> "urges",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.\n\nVestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/187x100.png/cc0000/ffffff",
                "name"=> "congue vivamus",
                "code"=> "laxer",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/182x100.png/dddddd/000000",
                "name"=> "sit amet eleifend",
                "code"=> "blurb",
                "description"=> "Sed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/208x100.png/cc0000/ffffff",
                "name"=> "id ligula",
                "code"=> "piers",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/122x100.png/5fa2dd/ffffff",
                "name"=> "sem fusce consequat",
                "code"=> "stain",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/187x100.png/cc0000/ffffff",
                "name"=> "aliquet ultrices erat",
                "code"=> "mowed",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/158x100.png/cc0000/ffffff",
                "name"=> "non mattis",
                "code"=> "cheat",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/167x100.png/dddddd/000000",
                "name"=> "potenti in eleifend",
                "code"=> "asses",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/192x100.png/5fa2dd/ffffff",
                "name"=> "posuere",
                "code"=> "coo's",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/141x100.png/5fa2dd/ffffff",
                "name"=> "eu mi",
                "code"=> "hided",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/200x100.png/ff4444/ffffff",
                "name"=> "erat fermentum",
                "code"=> "hug's",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/166x100.png/cc0000/ffffff",
                "name"=> "quam sapien varius",
                "code"=> "ravel",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/cc0000/ffffff",
                "name"=> "sagittis",
                "code"=> "verse",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/248x100.png/5fa2dd/ffffff",
                "name"=> "diam vitae quam",
                "code"=> "rat's",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/211x100.png/5fa2dd/ffffff",
                "name"=> "ut nulla sed",
                "code"=> "sagas",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/109x100.png/ff4444/ffffff",
                "name"=> "pellentesque at",
                "code"=> "ovals",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/117x100.png/cc0000/ffffff",
                "name"=> "nibh in quis",
                "code"=> "beefs",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/146x100.png/ff4444/ffffff",
                "name"=> "elementum",
                "code"=> "fungi",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/152x100.png/5fa2dd/ffffff",
                "name"=> "sed tincidunt",
                "code"=> "age's",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.\n\nMauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/211x100.png/dddddd/000000",
                "name"=> "sit",
                "code"=> "shone",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/224x100.png/dddddd/000000",
                "name"=> "convallis",
                "code"=> "mules",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/242x100.png/5fa2dd/ffffff",
                "name"=> "nulla facilisi cras",
                "code"=> "vomit",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/227x100.png/dddddd/000000",
                "name"=> "cras in purus",
                "code"=> "lilts",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/121x100.png/5fa2dd/ffffff",
                "name"=> "gravida",
                "code"=> "liken",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/168x100.png/ff4444/ffffff",
                "name"=> "nam dui proin",
                "code"=> "lords",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/164x100.png/ff4444/ffffff",
                "name"=> "morbi",
                "code"=> "glens",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/159x100.png/dddddd/000000",
                "name"=> "curae nulla",
                "code"=> "trump",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/189x100.png/dddddd/000000",
                "name"=> "massa quis augue",
                "code"=> "begun",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/115x100.png/ff4444/ffffff",
                "name"=> "vel nulla",
                "code"=> "dozes",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/128x100.png/cc0000/ffffff",
                "name"=> "sed",
                "code"=> "roofs",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/247x100.png/cc0000/ffffff",
                "name"=> "nulla tempus vivamus",
                "code"=> "ion's",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/233x100.png/ff4444/ffffff",
                "name"=> "luctus",
                "code"=> "jaded",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/132x100.png/5fa2dd/ffffff",
                "name"=> "commodo vulputate justo",
                "code"=> "yap's",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/188x100.png/dddddd/000000",
                "name"=> "suspendisse potenti in",
                "code"=> "weary",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.\n\nVestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/231x100.png/dddddd/000000",
                "name"=> "ut",
                "code"=> "bug's",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/191x100.png/5fa2dd/ffffff",
                "name"=> "ut",
                "code"=> "scums",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/234x100.png/cc0000/ffffff",
                "name"=> "quam turpis",
                "code"=> "sixty",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/156x100.png/dddddd/000000",
                "name"=> "et magnis dis",
                "code"=> "cheap",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.\n\nIn congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/184x100.png/dddddd/000000",
                "name"=> "quis turpis",
                "code"=> "curry",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/206x100.png/5fa2dd/ffffff",
                "name"=> "nulla",
                "code"=> "scans",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.\n\nVestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/151x100.png/ff4444/ffffff",
                "name"=> "quis",
                "code"=> "duped",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/157x100.png/dddddd/000000",
                "name"=> "amet sem",
                "code"=> "fez's",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/136x100.png/dddddd/000000",
                "name"=> "molestie lorem",
                "code"=> "drove",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/232x100.png/5fa2dd/ffffff",
                "name"=> "sit amet cursus",
                "code"=> "filed",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/5fa2dd/ffffff",
                "name"=> "gravida",
                "code"=> "rarer",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.\n\nCurabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/113x100.png/5fa2dd/ffffff",
                "name"=> "dolor quis odio",
                "code"=> "males",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/197x100.png/5fa2dd/ffffff",
                "name"=> "accumsan tortor quis",
                "code"=> "lucky",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/116x100.png/dddddd/000000",
                "name"=> "nascetur ridiculus",
                "code"=> "night",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/223x100.png/5fa2dd/ffffff",
                "name"=> "morbi porttitor lorem",
                "code"=> "album",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/225x100.png/dddddd/000000",
                "name"=> "ultrices libero",
                "code"=> "fluid",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/192x100.png/5fa2dd/ffffff",
                "name"=> "metus",
                "code"=> "fresh",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.\n\nMorbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/183x100.png/dddddd/000000",
                "name"=> "montes nascetur ridiculus",
                "code"=> "epics",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/196x100.png/dddddd/000000",
                "name"=> "sit",
                "code"=> "prows",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/209x100.png/dddddd/000000",
                "name"=> "sapien",
                "code"=> "grubs",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.\n\nCurabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/186x100.png/5fa2dd/ffffff",
                "name"=> "maecenas ut",
                "code"=> "limit",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.\n\nPellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/172x100.png/cc0000/ffffff",
                "name"=> "id ornare",
                "code"=> "peace",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.\n\nProin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/ff4444/ffffff",
                "name"=> "tempus",
                "code"=> "filly",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/227x100.png/5fa2dd/ffffff",
                "name"=> "vulputate",
                "code"=> "reaps",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/136x100.png/dddddd/000000",
                "name"=> "volutpat sapien arcu",
                "code"=> "pumps",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/125x100.png/cc0000/ffffff",
                "name"=> "eget eleifend luctus",
                "code"=> "law's",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/236x100.png/5fa2dd/ffffff",
                "name"=> "donec ut dolor",
                "code"=> "tenor",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/112x100.png/dddddd/000000",
                "name"=> "a nibh",
                "code"=> "liken",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/108x100.png/cc0000/ffffff",
                "name"=> "curae",
                "code"=> "baked",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/227x100.png/dddddd/000000",
                "name"=> "eu",
                "code"=> "gybed",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/143x100.png/5fa2dd/ffffff",
                "name"=> "neque",
                "code"=> "lad's",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.\n\nQuisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/204x100.png/cc0000/ffffff",
                "name"=> "vitae consectetuer",
                "code"=> "gaits",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/246x100.png/ff4444/ffffff",
                "name"=> "nulla tellus in",
                "code"=> "dunes",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/109x100.png/ff4444/ffffff",
                "name"=> "nulla ultrices aliquet",
                "code"=> "wowed",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.\n\nPellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/167x100.png/cc0000/ffffff",
                "name"=> "auctor gravida",
                "code"=> "timid",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/110x100.png/5fa2dd/ffffff",
                "name"=> "lacus",
                "code"=> "grips",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/242x100.png/cc0000/ffffff",
                "name"=> "convallis",
                "code"=> "ass's",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/223x100.png/5fa2dd/ffffff",
                "name"=> "ut at",
                "code"=> "moral",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/168x100.png/5fa2dd/ffffff",
                "name"=> "tellus nisi",
                "code"=> "talon",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/196x100.png/ff4444/ffffff",
                "name"=> "ut dolor",
                "code"=> "sucks",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/101x100.png/dddddd/000000",
                "name"=> "faucibus orci",
                "code"=> "spire",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/213x100.png/cc0000/ffffff",
                "name"=> "at velit vivamus",
                "code"=> "ferry",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/240x100.png/5fa2dd/ffffff",
                "name"=> "nullam",
                "code"=> "frost",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.\n\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/156x100.png/5fa2dd/ffffff",
                "name"=> "ipsum",
                "code"=> "shoon",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/163x100.png/dddddd/000000",
                "name"=> "ultrices phasellus id",
                "code"=> "sheds",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.\n\nAenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/235x100.png/ff4444/ffffff",
                "name"=> "amet turpis",
                "code"=> "abode",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/142x100.png/cc0000/ffffff",
                "name"=> "nulla ut erat",
                "code"=> "embed",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/157x100.png/cc0000/ffffff",
                "name"=> "pharetra magna",
                "code"=> "cooks",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/142x100.png/dddddd/000000",
                "name"=> "lacinia",
                "code"=> "reset",
                "description"=> "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.\n\nIn sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/238x100.png/cc0000/ffffff",
                "name"=> "enim",
                "code"=> "croon",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/128x100.png/cc0000/ffffff",
                "name"=> "dui",
                "code"=> "dunce",
                "description"=> "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.\n\nIn sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/dddddd/000000",
                "name"=> "ligula sit",
                "code"=> "dryer",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/167x100.png/ff4444/ffffff",
                "name"=> "mattis",
                "code"=> "heros",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/234x100.png/5fa2dd/ffffff",
                "name"=> "montes nascetur ridiculus",
                "code"=> "elbow",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/140x100.png/ff4444/ffffff",
                "name"=> "sem",
                "code"=> "ruing",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/227x100.png/cc0000/ffffff",
                "name"=> "quisque ut",
                "code"=> "ether",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.\n\nMaecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/dddddd/000000",
                "name"=> "ultrices libero",
                "code"=> "fully",
                "description"=> "Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/224x100.png/cc0000/ffffff",
                "name"=> "nullam orci",
                "code"=> "nests",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/147x100.png/5fa2dd/ffffff",
                "name"=> "mattis egestas",
                "code"=> "aside",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/117x100.png/cc0000/ffffff",
                "name"=> "congue risus",
                "code"=> "minks",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/158x100.png/5fa2dd/ffffff",
                "name"=> "mauris eget",
                "code"=> "carve",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/215x100.png/5fa2dd/ffffff",
                "name"=> "augue luctus tincidunt",
                "code"=> "knots",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/145x100.png/ff4444/ffffff",
                "name"=> "dictumst",
                "code"=> "muted",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/cc0000/ffffff",
                "name"=> "quis libero",
                "code"=> "table",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/248x100.png/ff4444/ffffff",
                "name"=> "eros",
                "code"=> "teeth",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/5fa2dd/ffffff",
                "name"=> "lectus",
                "code"=> "con's",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/151x100.png/5fa2dd/ffffff",
                "name"=> "nibh ligula nec",
                "code"=> "rigid",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/154x100.png/ff4444/ffffff",
                "name"=> "tempus",
                "code"=> "delay",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/117x100.png/dddddd/000000",
                "name"=> "ut nunc vestibulum",
                "code"=> "ain't",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/144x100.png/ff4444/ffffff",
                "name"=> "quisque",
                "code"=> "sodas",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/156x100.png/5fa2dd/ffffff",
                "name"=> "congue",
                "code"=> "donut",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/236x100.png/cc0000/ffffff",
                "name"=> "arcu adipiscing",
                "code"=> "feces",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/147x100.png/dddddd/000000",
                "name"=> "ac diam",
                "code"=> "lease",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/111x100.png/5fa2dd/ffffff",
                "name"=> "massa",
                "code"=> "liker",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/161x100.png/dddddd/000000",
                "name"=> "aliquet",
                "code"=> "aid's",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/139x100.png/5fa2dd/ffffff",
                "name"=> "purus phasellus",
                "code"=> "corns",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/152x100.png/dddddd/000000",
                "name"=> "morbi",
                "code"=> "sleet",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/162x100.png/5fa2dd/ffffff",
                "name"=> "dis parturient montes",
                "code"=> "lamer",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/109x100.png/cc0000/ffffff",
                "name"=> "sit",
                "code"=> "jades",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/222x100.png/cc0000/ffffff",
                "name"=> "accumsan",
                "code"=> "genus",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/112x100.png/dddddd/000000",
                "name"=> "pede justo lacinia",
                "code"=> "biked",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/201x100.png/dddddd/000000",
                "name"=> "diam",
                "code"=> "asked",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/151x100.png/5fa2dd/ffffff",
                "name"=> "cras",
                "code"=> "filet",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/148x100.png/ff4444/ffffff",
                "name"=> "volutpat convallis",
                "code"=> "grips",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/103x100.png/cc0000/ffffff",
                "name"=> "erat nulla tempus",
                "code"=> "leapt",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/187x100.png/cc0000/ffffff",
                "name"=> "habitasse platea dictumst",
                "code"=> "menus",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.\n\nVestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/183x100.png/ff4444/ffffff",
                "name"=> "vitae",
                "code"=> "ovens",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.\n\nCurabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/168x100.png/5fa2dd/ffffff",
                "name"=> "pretium iaculis justo",
                "code"=> "balmy",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/250x100.png/5fa2dd/ffffff",
                "name"=> "nibh fusce",
                "code"=> "expel",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/132x100.png/ff4444/ffffff",
                "name"=> "nascetur",
                "code"=> "zones",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/177x100.png/ff4444/ffffff",
                "name"=> "orci mauris lacinia",
                "code"=> "blood",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/201x100.png/dddddd/000000",
                "name"=> "accumsan",
                "code"=> "draws",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/120x100.png/5fa2dd/ffffff",
                "name"=> "ligula vehicula consequat",
                "code"=> "dined",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/135x100.png/ff4444/ffffff",
                "name"=> "id",
                "code"=> "voids",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/230x100.png/dddddd/000000",
                "name"=> "in hac",
                "code"=> "kneed",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/249x100.png/ff4444/ffffff",
                "name"=> "orci luctus",
                "code"=> "oiled",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/232x100.png/5fa2dd/ffffff",
                "name"=> "nibh",
                "code"=> "feels",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/158x100.png/dddddd/000000",
                "name"=> "purus phasellus",
                "code"=> "lab's",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.\n\nCurabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/204x100.png/dddddd/000000",
                "name"=> "fusce posuere",
                "code"=> "axing",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/246x100.png/5fa2dd/ffffff",
                "name"=> "enim blandit mi",
                "code"=> "tinge",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.\n\nMaecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/161x100.png/ff4444/ffffff",
                "name"=> "id",
                "code"=> "leers",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\n\nEtiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/dddddd/000000",
                "name"=> "proin",
                "code"=> "punts",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.\n\nNam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/129x100.png/ff4444/ffffff",
                "name"=> "quis",
                "code"=> "hip's",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.\n\nIn congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/235x100.png/ff4444/ffffff",
                "name"=> "eleifend",
                "code"=> "align",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/131x100.png/cc0000/ffffff",
                "name"=> "vestibulum",
                "code"=> "chaos",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/124x100.png/ff4444/ffffff",
                "name"=> "leo maecenas pulvinar",
                "code"=> "bound",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/160x100.png/ff4444/ffffff",
                "name"=> "diam",
                "code"=> "mauve",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/240x100.png/5fa2dd/ffffff",
                "name"=> "volutpat erat quisque",
                "code"=> "blitz",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/250x100.png/ff4444/ffffff",
                "name"=> "quam",
                "code"=> "caked",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.\n\nPellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/ff4444/ffffff",
                "name"=> "in",
                "code"=> "calve",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/121x100.png/5fa2dd/ffffff",
                "name"=> "est",
                "code"=> "align",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.\n\nMorbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/137x100.png/cc0000/ffffff",
                "name"=> "nonummy maecenas tincidunt",
                "code"=> "fines",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.\n\nCras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/139x100.png/dddddd/000000",
                "name"=> "ligula vehicula consequat",
                "code"=> "exalt",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/225x100.png/5fa2dd/ffffff",
                "name"=> "nulla ultrices",
                "code"=> "midst",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.\n\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/220x100.png/ff4444/ffffff",
                "name"=> "gravida sem praesent",
                "code"=> "exist",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/159x100.png/dddddd/000000",
                "name"=> "id",
                "code"=> "nag's",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/249x100.png/cc0000/ffffff",
                "name"=> "in purus",
                "code"=> "grape",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/102x100.png/ff4444/ffffff",
                "name"=> "eget",
                "code"=> "gybes",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/235x100.png/cc0000/ffffff",
                "name"=> "quis lectus suspendisse",
                "code"=> "askew",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/155x100.png/cc0000/ffffff",
                "name"=> "vel",
                "code"=> "dupes",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.\n\nVestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/116x100.png/ff4444/ffffff",
                "name"=> "sit amet sem",
                "code"=> "syrup",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/186x100.png/ff4444/ffffff",
                "name"=> "odio",
                "code"=> "lug's",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.\n\nInteger tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/145x100.png/5fa2dd/ffffff",
                "name"=> "montes nascetur",
                "code"=> "films",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/158x100.png/ff4444/ffffff",
                "name"=> "rutrum neque aenean",
                "code"=> "milky",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/150x100.png/dddddd/000000",
                "name"=> "eget tincidunt eget",
                "code"=> "waver",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/211x100.png/5fa2dd/ffffff",
                "name"=> "enim leo",
                "code"=> "junta",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.\n\nMorbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/107x100.png/cc0000/ffffff",
                "name"=> "luctus",
                "code"=> "twigs",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/200x100.png/cc0000/ffffff",
                "name"=> "quis libero nullam",
                "code"=> "pears",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/158x100.png/ff4444/ffffff",
                "name"=> "condimentum",
                "code"=> "askew",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.\n\nCurabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/178x100.png/dddddd/000000",
                "name"=> "nullam",
                "code"=> "shirk",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/205x100.png/dddddd/000000",
                "name"=> "gravida sem praesent",
                "code"=> "aloft",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/cc0000/ffffff",
                "name"=> "in sagittis dui",
                "code"=> "ice's",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/226x100.png/cc0000/ffffff",
                "name"=> "libero",
                "code"=> "crabs",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/105x100.png/cc0000/ffffff",
                "name"=> "nulla",
                "code"=> "haven",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/147x100.png/dddddd/000000",
                "name"=> "interdum in",
                "code"=> "hunks",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/5fa2dd/ffffff",
                "name"=> "luctus ultricies",
                "code"=> "gaged",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/179x100.png/cc0000/ffffff",
                "name"=> "odio",
                "code"=> "lunge",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/118x100.png/dddddd/000000",
                "name"=> "ac",
                "code"=> "slept",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.\n\nVestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/192x100.png/cc0000/ffffff",
                "name"=> "fermentum justo",
                "code"=> "drove",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/150x100.png/dddddd/000000",
                "name"=> "pede",
                "code"=> "aunts",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\n\nEtiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/207x100.png/cc0000/ffffff",
                "name"=> "sit",
                "code"=> "bee's",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/116x100.png/cc0000/ffffff",
                "name"=> "diam",
                "code"=> "gibed",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.\n\nMorbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/166x100.png/dddddd/000000",
                "name"=> "consequat",
                "code"=> "heard",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/197x100.png/cc0000/ffffff",
                "name"=> "quam",
                "code"=> "walks",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/168x100.png/ff4444/ffffff",
                "name"=> "libero",
                "code"=> "racer",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/163x100.png/ff4444/ffffff",
                "name"=> "justo in hac",
                "code"=> "chart",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/249x100.png/ff4444/ffffff",
                "name"=> "molestie lorem quisque",
                "code"=> "pro's",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/179x100.png/5fa2dd/ffffff",
                "name"=> "in sagittis",
                "code"=> "lords",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/175x100.png/cc0000/ffffff",
                "name"=> "vitae consectetuer eget",
                "code"=> "lured",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.\n\nIn congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/243x100.png/dddddd/000000",
                "name"=> "amet consectetuer adipiscing",
                "code"=> "VIP's",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/151x100.png/ff4444/ffffff",
                "name"=> "ac",
                "code"=> "may's",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/139x100.png/ff4444/ffffff",
                "name"=> "consequat ut nulla",
                "code"=> "crumb",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/182x100.png/dddddd/000000",
                "name"=> "id pretium",
                "code"=> "penny",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/137x100.png/dddddd/000000",
                "name"=> "vestibulum eget",
                "code"=> "metal",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.\n\nPellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/104x100.png/ff4444/ffffff",
                "name"=> "sed vel",
                "code"=> "needs",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/102x100.png/dddddd/000000",
                "name"=> "et ultrices",
                "code"=> "lolls",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/100x100.png/cc0000/ffffff",
                "name"=> "dapibus dolor vel",
                "code"=> "genii",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/184x100.png/5fa2dd/ffffff",
                "name"=> "non quam nec",
                "code"=> "aspen",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/193x100.png/ff4444/ffffff",
                "name"=> "nec",
                "code"=> "ebony",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/178x100.png/cc0000/ffffff",
                "name"=> "dui maecenas tristique",
                "code"=> "joint",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/241x100.png/cc0000/ffffff",
                "name"=> "ante vestibulum",
                "code"=> "pot's",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/224x100.png/dddddd/000000",
                "name"=> "consequat in consequat",
                "code"=> "booms",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/cc0000/ffffff",
                "name"=> "nulla facilisi",
                "code"=> "oar's",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/168x100.png/ff4444/ffffff",
                "name"=> "dui nec",
                "code"=> "tea's",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/186x100.png/dddddd/000000",
                "name"=> "consequat dui nec",
                "code"=> "shake",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/238x100.png/cc0000/ffffff",
                "name"=> "mus vivamus",
                "code"=> "abbot",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/249x100.png/cc0000/ffffff",
                "name"=> "sit amet",
                "code"=> "spays",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/157x100.png/cc0000/ffffff",
                "name"=> "etiam",
                "code"=> "owing",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/181x100.png/cc0000/ffffff",
                "name"=> "amet diam in",
                "code"=> "waver",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/cc0000/ffffff",
                "name"=> "pellentesque quisque porta",
                "code"=> "forgo",
                "description"=> "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/168x100.png/dddddd/000000",
                "name"=> "elit",
                "code"=> "alien",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.\n\nPellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/190x100.png/cc0000/ffffff",
                "name"=> "quam fringilla rhoncus",
                "code"=> "pants",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/245x100.png/ff4444/ffffff",
                "name"=> "id",
                "code"=> "scope",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/221x100.png/dddddd/000000",
                "name"=> "sollicitudin",
                "code"=> "house",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/136x100.png/ff4444/ffffff",
                "name"=> "nisl",
                "code"=> "skits",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.\n\nCurabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/236x100.png/cc0000/ffffff",
                "name"=> "lobortis est",
                "code"=> "bison",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/211x100.png/ff4444/ffffff",
                "name"=> "luctus et",
                "code"=> "adorn",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/106x100.png/cc0000/ffffff",
                "name"=> "enim sit",
                "code"=> "freak",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/136x100.png/dddddd/000000",
                "name"=> "leo",
                "code"=> "soaks",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/247x100.png/5fa2dd/ffffff",
                "name"=> "eu tincidunt in",
                "code"=> "leery",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/218x100.png/cc0000/ffffff",
                "name"=> "maecenas",
                "code"=> "berry",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.\n\nMaecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/166x100.png/ff4444/ffffff",
                "name"=> "vitae",
                "code"=> "marts",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/198x100.png/dddddd/000000",
                "name"=> "congue diam",
                "code"=> "joy's",
                "description"=> "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/192x100.png/cc0000/ffffff",
                "name"=> "justo pellentesque viverra",
                "code"=> "guy's",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/134x100.png/ff4444/ffffff",
                "name"=> "id turpis",
                "code"=> "toast",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/180x100.png/dddddd/000000",
                "name"=> "aliquam lacus",
                "code"=> "appal",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/208x100.png/dddddd/000000",
                "name"=> "in quam fringilla",
                "code"=> "grays",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/250x100.png/cc0000/ffffff",
                "name"=> "arcu libero rutrum",
                "code"=> "balms",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/105x100.png/ff4444/ffffff",
                "name"=> "volutpat",
                "code"=> "frock",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/170x100.png/5fa2dd/ffffff",
                "name"=> "nascetur ridiculus",
                "code"=> "clock",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/181x100.png/5fa2dd/ffffff",
                "name"=> "habitasse platea",
                "code"=> "tiffs",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/201x100.png/5fa2dd/ffffff",
                "name"=> "ac est lacinia",
                "code"=> "prove",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/243x100.png/dddddd/000000",
                "name"=> "risus",
                "code"=> "swoop",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.\n\nIn congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/157x100.png/dddddd/000000",
                "name"=> "proin leo odio",
                "code"=> "key's",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.\n\nProin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/116x100.png/ff4444/ffffff",
                "name"=> "quam",
                "code"=> "skirt",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/160x100.png/dddddd/000000",
                "name"=> "at",
                "code"=> "lines",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/107x100.png/dddddd/000000",
                "name"=> "lorem quisque",
                "code"=> "licks",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/156x100.png/cc0000/ffffff",
                "name"=> "a pede posuere",
                "code"=> "balks",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/107x100.png/5fa2dd/ffffff",
                "name"=> "in sagittis dui",
                "code"=> "slows",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.\n\nMauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/209x100.png/ff4444/ffffff",
                "name"=> "pellentesque at",
                "code"=> "crumb",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/245x100.png/ff4444/ffffff",
                "name"=> "sapien",
                "code"=> "fours",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/167x100.png/dddddd/000000",
                "name"=> "vulputate ut",
                "code"=> "tea's",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/119x100.png/dddddd/000000",
                "name"=> "porttitor lacus at",
                "code"=> "snows",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.\n\nProin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/236x100.png/cc0000/ffffff",
                "name"=> "massa id nisl",
                "code"=> "acres",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.\n\nMorbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/245x100.png/cc0000/ffffff",
                "name"=> "tristique",
                "code"=> "her's",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/209x100.png/5fa2dd/ffffff",
                "name"=> "potenti in",
                "code"=> "din's",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/243x100.png/5fa2dd/ffffff",
                "name"=> "est donec",
                "code"=> "petal",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/205x100.png/ff4444/ffffff",
                "name"=> "augue a",
                "code"=> "theta",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/205x100.png/5fa2dd/ffffff",
                "name"=> "integer aliquet",
                "code"=> "watts",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/106x100.png/cc0000/ffffff",
                "name"=> "et tempus semper",
                "code"=> "nudes",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/109x100.png/ff4444/ffffff",
                "name"=> "in quis justo",
                "code"=> "tubed",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/161x100.png/ff4444/ffffff",
                "name"=> "vulputate ut",
                "code"=> "gages",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/127x100.png/5fa2dd/ffffff",
                "name"=> "rutrum",
                "code"=> "moose",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/188x100.png/5fa2dd/ffffff",
                "name"=> "in est",
                "code"=> "waxes",
                "description"=> "Sed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/164x100.png/dddddd/000000",
                "name"=> "pulvinar",
                "code"=> "slogs",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.\n\nVestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/131x100.png/ff4444/ffffff",
                "name"=> "orci luctus",
                "code"=> "seeks",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/115x100.png/ff4444/ffffff",
                "name"=> "non ligula pellentesque",
                "code"=> "moons",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/143x100.png/cc0000/ffffff",
                "name"=> "sed tristique",
                "code"=> "toxin",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/196x100.png/ff4444/ffffff",
                "name"=> "montes",
                "code"=> "fried",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.\n\nCurabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/200x100.png/5fa2dd/ffffff",
                "name"=> "suspendisse potenti nullam",
                "code"=> "files",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/222x100.png/dddddd/000000",
                "name"=> "ultrices",
                "code"=> "black",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/112x100.png/cc0000/ffffff",
                "name"=> "ultrices",
                "code"=> "stock",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/221x100.png/5fa2dd/ffffff",
                "name"=> "dui vel sem",
                "code"=> "slops",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.\n\nCurabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/152x100.png/ff4444/ffffff",
                "name"=> "at velit",
                "code"=> "mamas",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/115x100.png/dddddd/000000",
                "name"=> "varius",
                "code"=> "tribe",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.\n\nIn congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/148x100.png/ff4444/ffffff",
                "name"=> "eget tincidunt",
                "code"=> "frown",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/187x100.png/ff4444/ffffff",
                "name"=> "amet nulla quisque",
                "code"=> "musty",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.\n\nFusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/245x100.png/5fa2dd/ffffff",
                "name"=> "vestibulum ante ipsum",
                "code"=> "abbot",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.\n\nSuspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/215x100.png/dddddd/000000",
                "name"=> "id turpis",
                "code"=> "spout",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/225x100.png/dddddd/000000",
                "name"=> "mauris non",
                "code"=> "ham's",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/233x100.png/ff4444/ffffff",
                "name"=> "egestas metus aenean",
                "code"=> "rot's",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/209x100.png/dddddd/000000",
                "name"=> "in tempor",
                "code"=> "brine",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/245x100.png/ff4444/ffffff",
                "name"=> "aenean fermentum",
                "code"=> "abate",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/147x100.png/dddddd/000000",
                "name"=> "lacinia",
                "code"=> "cot's",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/138x100.png/5fa2dd/ffffff",
                "name"=> "platea dictumst etiam",
                "code"=> "laser",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/234x100.png/cc0000/ffffff",
                "name"=> "suspendisse accumsan",
                "code"=> "fiver",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.\n\nMauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/216x100.png/dddddd/000000",
                "name"=> "maecenas pulvinar",
                "code"=> "would",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/136x100.png/cc0000/ffffff",
                "name"=> "vivamus",
                "code"=> "night",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/191x100.png/cc0000/ffffff",
                "name"=> "nullam sit",
                "code"=> "feels",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.\n\nPraesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/129x100.png/cc0000/ffffff",
                "name"=> "vestibulum sed magna",
                "code"=> "score",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/155x100.png/cc0000/ffffff",
                "name"=> "in",
                "code"=> "burns",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/126x100.png/ff4444/ffffff",
                "name"=> "primis in",
                "code"=> "annex",
                "description"=> "Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/202x100.png/cc0000/ffffff",
                "name"=> "ligula vehicula",
                "code"=> "rowdy",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/247x100.png/dddddd/000000",
                "name"=> "sapien",
                "code"=> "liken",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/198x100.png/5fa2dd/ffffff",
                "name"=> "duis at velit",
                "code"=> "peace",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.\n\nMauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/165x100.png/dddddd/000000",
                "name"=> "nibh",
                "code"=> "ashen",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/177x100.png/5fa2dd/ffffff",
                "name"=> "amet cursus id",
                "code"=> "stirs",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/128x100.png/cc0000/ffffff",
                "name"=> "varius",
                "code"=> "liven",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.\n\nPraesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/213x100.png/dddddd/000000",
                "name"=> "quam a",
                "code"=> "flint",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.\n\nFusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/152x100.png/ff4444/ffffff",
                "name"=> "egestas metus aenean",
                "code"=> "means",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/171x100.png/cc0000/ffffff",
                "name"=> "at nibh in",
                "code"=> "piano",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/199x100.png/cc0000/ffffff",
                "name"=> "aliquet massa id",
                "code"=> "minor",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.\n\nMaecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/152x100.png/dddddd/000000",
                "name"=> "cursus",
                "code"=> "hug's",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\n\nEtiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/219x100.png/ff4444/ffffff",
                "name"=> "et magnis",
                "code"=> "stows",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/154x100.png/cc0000/ffffff",
                "name"=> "fusce posuere",
                "code"=> "scour",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.\n\nPellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/237x100.png/cc0000/ffffff",
                "name"=> "curae",
                "code"=> "troll",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/dddddd/000000",
                "name"=> "varius nulla",
                "code"=> "nag's",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/230x100.png/cc0000/ffffff",
                "name"=> "a odio in",
                "code"=> "sneer",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/177x100.png/5fa2dd/ffffff",
                "name"=> "dictumst etiam",
                "code"=> "guide",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/212x100.png/ff4444/ffffff",
                "name"=> "lectus aliquam",
                "code"=> "fishy",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/198x100.png/dddddd/000000",
                "name"=> "ut odio",
                "code"=> "ought",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/237x100.png/ff4444/ffffff",
                "name"=> "sem",
                "code"=> "highs",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/146x100.png/cc0000/ffffff",
                "name"=> "pretium iaculis",
                "code"=> "baker",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/108x100.png/dddddd/000000",
                "name"=> "sed magna at",
                "code"=> "dealt",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/240x100.png/dddddd/000000",
                "name"=> "massa id",
                "code"=> "teams",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.\n\nVestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/157x100.png/dddddd/000000",
                "name"=> "vestibulum ante ipsum",
                "code"=> "skunk",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/106x100.png/ff4444/ffffff",
                "name"=> "proin interdum mauris",
                "code"=> "mauve",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/185x100.png/dddddd/000000",
                "name"=> "quis",
                "code"=> "bar's",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/221x100.png/dddddd/000000",
                "name"=> "purus",
                "code"=> "torsi",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/160x100.png/dddddd/000000",
                "name"=> "in",
                "code"=> "kinda",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/161x100.png/5fa2dd/ffffff",
                "name"=> "dui proin leo",
                "code"=> "sum's",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.\n\nNam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/101x100.png/ff4444/ffffff",
                "name"=> "luctus et ultrices",
                "code"=> "tabus",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.\n\nNam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/205x100.png/ff4444/ffffff",
                "name"=> "sed tincidunt",
                "code"=> "spasm",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/169x100.png/cc0000/ffffff",
                "name"=> "odio curabitur",
                "code"=> "gross",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/212x100.png/cc0000/ffffff",
                "name"=> "ut nulla",
                "code"=> "creed",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/108x100.png/dddddd/000000",
                "name"=> "rhoncus sed vestibulum",
                "code"=> "cap's",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/231x100.png/5fa2dd/ffffff",
                "name"=> "in",
                "code"=> "wheat",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/212x100.png/cc0000/ffffff",
                "name"=> "libero nullam",
                "code"=> "newts",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.\n\nSuspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/203x100.png/ff4444/ffffff",
                "name"=> "sit amet turpis",
                "code"=> "delis",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/216x100.png/dddddd/000000",
                "name"=> "blandit lacinia",
                "code"=> "mails",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/167x100.png/ff4444/ffffff",
                "name"=> "ac consequat metus",
                "code"=> "order",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/174x100.png/cc0000/ffffff",
                "name"=> "iaculis congue vivamus",
                "code"=> "ovary",
                "description"=> "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.\n\nIn sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/110x100.png/5fa2dd/ffffff",
                "name"=> "habitasse platea",
                "code"=> "burps",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/204x100.png/cc0000/ffffff",
                "name"=> "donec diam",
                "code"=> "ticks",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.\n\nCurabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/201x100.png/dddddd/000000",
                "name"=> "ante nulla justo",
                "code"=> "foggy",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/165x100.png/ff4444/ffffff",
                "name"=> "morbi",
                "code"=> "beast",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\n\nEtiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/158x100.png/5fa2dd/ffffff",
                "name"=> "quisque porta volutpat",
                "code"=> "surer",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.\n\nCurabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/207x100.png/5fa2dd/ffffff",
                "name"=> "felis eu sapien",
                "code"=> "crabs",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/240x100.png/dddddd/000000",
                "name"=> "morbi ut",
                "code"=> "spank",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/111x100.png/dddddd/000000",
                "name"=> "praesent id",
                "code"=> "spies",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/205x100.png/dddddd/000000",
                "name"=> "bibendum",
                "code"=> "vital",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/216x100.png/ff4444/ffffff",
                "name"=> "fusce consequat",
                "code"=> "fix's",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/146x100.png/cc0000/ffffff",
                "name"=> "augue vestibulum rutrum",
                "code"=> "spuds",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/228x100.png/5fa2dd/ffffff",
                "name"=> "nullam molestie nibh",
                "code"=> "apter",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/246x100.png/5fa2dd/ffffff",
                "name"=> "nisl",
                "code"=> "fussy",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/169x100.png/cc0000/ffffff",
                "name"=> "nec sem",
                "code"=> "nudes",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.\n\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/154x100.png/5fa2dd/ffffff",
                "name"=> "justo in blandit",
                "code"=> "solar",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/106x100.png/5fa2dd/ffffff",
                "name"=> "sed",
                "code"=> "caged",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/240x100.png/5fa2dd/ffffff",
                "name"=> "tincidunt eu felis",
                "code"=> "marry",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/167x100.png/cc0000/ffffff",
                "name"=> "turpis donec",
                "code"=> "slick",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.\n\nPraesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/157x100.png/dddddd/000000",
                "name"=> "justo maecenas",
                "code"=> "plane",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/109x100.png/dddddd/000000",
                "name"=> "orci",
                "code"=> "frail",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/169x100.png/ff4444/ffffff",
                "name"=> "ut nulla sed",
                "code"=> "helps",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/142x100.png/ff4444/ffffff",
                "name"=> "interdum mauris ullamcorper",
                "code"=> "warps",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.\n\nMaecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/224x100.png/cc0000/ffffff",
                "name"=> "vel",
                "code"=> "nasal",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.\n\nMaecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/dddddd/000000",
                "name"=> "posuere felis sed",
                "code"=> "shove",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/124x100.png/cc0000/ffffff",
                "name"=> "sapien non",
                "code"=> "bonus",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.\n\nSuspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/5fa2dd/ffffff",
                "name"=> "volutpat convallis morbi",
                "code"=> "roost",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/152x100.png/ff4444/ffffff",
                "name"=> "pulvinar",
                "code"=> "slash",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.\n\nPraesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/109x100.png/dddddd/000000",
                "name"=> "vel pede morbi",
                "code"=> "roomy",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/104x100.png/5fa2dd/ffffff",
                "name"=> "volutpat convallis morbi",
                "code"=> "vials",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/122x100.png/ff4444/ffffff",
                "name"=> "neque vestibulum",
                "code"=> "churn",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/162x100.png/5fa2dd/ffffff",
                "name"=> "nibh in",
                "code"=> "trees",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/216x100.png/5fa2dd/ffffff",
                "name"=> "suspendisse potenti",
                "code"=> "quirk",
                "description"=> "Sed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/181x100.png/ff4444/ffffff",
                "name"=> "sed",
                "code"=> "dusky",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/221x100.png/ff4444/ffffff",
                "name"=> "tortor eu",
                "code"=> "adobe",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.\n\nQuisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/124x100.png/5fa2dd/ffffff",
                "name"=> "laoreet ut",
                "code"=> "stung",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/139x100.png/cc0000/ffffff",
                "name"=> "in",
                "code"=> "trued",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/209x100.png/5fa2dd/ffffff",
                "name"=> "diam",
                "code"=> "hip's",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.\n\nCurabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/239x100.png/dddddd/000000",
                "name"=> "eros viverra",
                "code"=> "lunar",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/117x100.png/5fa2dd/ffffff",
                "name"=> "eget congue",
                "code"=> "expel",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/225x100.png/5fa2dd/ffffff",
                "name"=> "velit",
                "code"=> "pangs",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/157x100.png/ff4444/ffffff",
                "name"=> "consectetuer eget",
                "code"=> "few's",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/205x100.png/ff4444/ffffff",
                "name"=> "odio condimentum id",
                "code"=> "aloud",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/5fa2dd/ffffff",
                "name"=> "nisl duis",
                "code"=> "gages",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/102x100.png/dddddd/000000",
                "name"=> "eu nibh quisque",
                "code"=> "waken",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/155x100.png/ff4444/ffffff",
                "name"=> "metus",
                "code"=> "wig's",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/182x100.png/ff4444/ffffff",
                "name"=> "in lacus",
                "code"=> "whine",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/187x100.png/5fa2dd/ffffff",
                "name"=> "et ultrices posuere",
                "code"=> "dizzy",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/130x100.png/ff4444/ffffff",
                "name"=> "sollicitudin mi",
                "code"=> "lager",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/232x100.png/5fa2dd/ffffff",
                "name"=> "ante ipsum",
                "code"=> "romps",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/166x100.png/ff4444/ffffff",
                "name"=> "nulla",
                "code"=> "allow",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/113x100.png/5fa2dd/ffffff",
                "name"=> "dui",
                "code"=> "cheep",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.\n\nAenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/177x100.png/cc0000/ffffff",
                "name"=> "id",
                "code"=> "fussy",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.\n\nCurabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/157x100.png/dddddd/000000",
                "name"=> "in faucibus",
                "code"=> "skulk",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.\n\nNam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/230x100.png/ff4444/ffffff",
                "name"=> "cras non velit",
                "code"=> "saint",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.\n\nPraesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/175x100.png/ff4444/ffffff",
                "name"=> "quisque",
                "code"=> "pasts",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/177x100.png/ff4444/ffffff",
                "name"=> "pharetra magna vestibulum",
                "code"=> "sop's",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/148x100.png/5fa2dd/ffffff",
                "name"=> "interdum in ante",
                "code"=> "balms",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/180x100.png/ff4444/ffffff",
                "name"=> "a feugiat et",
                "code"=> "dye's",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/100x100.png/dddddd/000000",
                "name"=> "vulputate",
                "code"=> "angel",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/204x100.png/dddddd/000000",
                "name"=> "nisl duis",
                "code"=> "china",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/230x100.png/cc0000/ffffff",
                "name"=> "habitasse platea dictumst",
                "code"=> "smile",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/202x100.png/ff4444/ffffff",
                "name"=> "a nibh",
                "code"=> "kiwis",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.\n\nMorbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/191x100.png/ff4444/ffffff",
                "name"=> "in eleifend",
                "code"=> "vigor",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.\n\nVestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/156x100.png/ff4444/ffffff",
                "name"=> "mauris sit amet",
                "code"=> "hat's",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/189x100.png/dddddd/000000",
                "name"=> "quis orci",
                "code"=> "pluck",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/101x100.png/5fa2dd/ffffff",
                "name"=> "curae",
                "code"=> "dunce",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.\n\nAenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/244x100.png/ff4444/ffffff",
                "name"=> "velit nec",
                "code"=> "blocs",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/143x100.png/dddddd/000000",
                "name"=> "mattis pulvinar",
                "code"=> "eon's",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/226x100.png/cc0000/ffffff",
                "name"=> "nec condimentum neque",
                "code"=> "spuds",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/101x100.png/cc0000/ffffff",
                "name"=> "placerat",
                "code"=> "waifs",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/108x100.png/ff4444/ffffff",
                "name"=> "maecenas tincidunt",
                "code"=> "scram",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/171x100.png/dddddd/000000",
                "name"=> "congue risus semper",
                "code"=> "homed",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/169x100.png/ff4444/ffffff",
                "name"=> "cras in",
                "code"=> "stink",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/149x100.png/ff4444/ffffff",
                "name"=> "dignissim vestibulum",
                "code"=> "wanes",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/172x100.png/dddddd/000000",
                "name"=> "erat eros viverra",
                "code"=> "ale's",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/136x100.png/5fa2dd/ffffff",
                "name"=> "vestibulum ac est",
                "code"=> "pyres",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/123x100.png/5fa2dd/ffffff",
                "name"=> "erat id mauris",
                "code"=> "prows",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/220x100.png/ff4444/ffffff",
                "name"=> "magna at nunc",
                "code"=> "delis",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/234x100.png/dddddd/000000",
                "name"=> "gravida",
                "code"=> "drily",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/149x100.png/dddddd/000000",
                "name"=> "pede",
                "code"=> "zooms",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/145x100.png/5fa2dd/ffffff",
                "name"=> "pellentesque",
                "code"=> "abbey",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.\n\nPraesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/165x100.png/dddddd/000000",
                "name"=> "eleifend",
                "code"=> "claws",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/147x100.png/ff4444/ffffff",
                "name"=> "non lectus aliquam",
                "code"=> "fords",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/209x100.png/dddddd/000000",
                "name"=> "tempus vivamus in",
                "code"=> "grape",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/145x100.png/cc0000/ffffff",
                "name"=> "eu tincidunt",
                "code"=> "bride",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/152x100.png/ff4444/ffffff",
                "name"=> "viverra pede ac",
                "code"=> "reach",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/143x100.png/dddddd/000000",
                "name"=> "ultrices libero",
                "code"=> "antic",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/242x100.png/cc0000/ffffff",
                "name"=> "in hac",
                "code"=> "shook",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/202x100.png/ff4444/ffffff",
                "name"=> "velit vivamus vel",
                "code"=> "wharf",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/133x100.png/ff4444/ffffff",
                "name"=> "ac diam",
                "code"=> "trays",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/226x100.png/dddddd/000000",
                "name"=> "odio consequat varius",
                "code"=> "sweep",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/108x100.png/ff4444/ffffff",
                "name"=> "ligula in lacus",
                "code"=> "shorn",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.\n\nCras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/123x100.png/ff4444/ffffff",
                "name"=> "nibh in lectus",
                "code"=> "longs",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/174x100.png/5fa2dd/ffffff",
                "name"=> "ut dolor",
                "code"=> "gulls",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/140x100.png/ff4444/ffffff",
                "name"=> "nulla tempus vivamus",
                "code"=> "cools",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.\n\nPraesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/232x100.png/cc0000/ffffff",
                "name"=> "duis bibendum",
                "code"=> "winks",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.\n\nFusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/122x100.png/5fa2dd/ffffff",
                "name"=> "vestibulum ante",
                "code"=> "finer",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/189x100.png/cc0000/ffffff",
                "name"=> "quis tortor id",
                "code"=> "relax",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.\n\nInteger tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/238x100.png/cc0000/ffffff",
                "name"=> "neque sapien",
                "code"=> "waste",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/234x100.png/ff4444/ffffff",
                "name"=> "mi integer",
                "code"=> "bused",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/237x100.png/dddddd/000000",
                "name"=> "lacinia eget",
                "code"=> "knoll",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/130x100.png/dddddd/000000",
                "name"=> "diam nam tristique",
                "code"=> "tardy",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/130x100.png/dddddd/000000",
                "name"=> "adipiscing elit",
                "code"=> "rev's",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/184x100.png/cc0000/ffffff",
                "name"=> "maecenas",
                "code"=> "mimed",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.\n\nCurabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/197x100.png/5fa2dd/ffffff",
                "name"=> "hac habitasse platea",
                "code"=> "caulk",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/140x100.png/cc0000/ffffff",
                "name"=> "integer non velit",
                "code"=> "abode",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.\n\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/114x100.png/cc0000/ffffff",
                "name"=> "tristique fusce congue",
                "code"=> "canes",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/114x100.png/ff4444/ffffff",
                "name"=> "sapien",
                "code"=> "flood",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/242x100.png/5fa2dd/ffffff",
                "name"=> "tristique",
                "code"=> "watts",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.\n\nPraesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/237x100.png/dddddd/000000",
                "name"=> "eget",
                "code"=> "horny",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/152x100.png/5fa2dd/ffffff",
                "name"=> "nisi vulputate nonummy",
                "code"=> "totes",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/194x100.png/ff4444/ffffff",
                "name"=> "neque",
                "code"=> "thaws",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/237x100.png/ff4444/ffffff",
                "name"=> "amet",
                "code"=> "blasé",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/135x100.png/dddddd/000000",
                "name"=> "mus",
                "code"=> "pecks",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/247x100.png/ff4444/ffffff",
                "name"=> "natoque penatibus",
                "code"=> "dozed",
                "description"=> "Sed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/179x100.png/cc0000/ffffff",
                "name"=> "eget",
                "code"=> "equal",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/147x100.png/dddddd/000000",
                "name"=> "molestie",
                "code"=> "sears",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/238x100.png/cc0000/ffffff",
                "name"=> "aliquam",
                "code"=> "papal",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/147x100.png/dddddd/000000",
                "name"=> "sit",
                "code"=> "rogue",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/238x100.png/dddddd/000000",
                "name"=> "quam pharetra",
                "code"=> "sight",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/125x100.png/ff4444/ffffff",
                "name"=> "sit amet",
                "code"=> "flask",
                "description"=> "Sed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/213x100.png/ff4444/ffffff",
                "name"=> "interdum mauris ullamcorper",
                "code"=> "elite",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.\n\nInteger ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/224x100.png/5fa2dd/ffffff",
                "name"=> "consequat morbi",
                "code"=> "mixer",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/120x100.png/cc0000/ffffff",
                "name"=> "varius integer",
                "code"=> "crags",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/242x100.png/cc0000/ffffff",
                "name"=> "tellus",
                "code"=> "carts",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/154x100.png/5fa2dd/ffffff",
                "name"=> "ligula nec sem",
                "code"=> "teams",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/117x100.png/dddddd/000000",
                "name"=> "id",
                "code"=> "abate",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.\n\nCras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/232x100.png/dddddd/000000",
                "name"=> "consectetuer adipiscing elit",
                "code"=> "leery",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.\n\nSuspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/206x100.png/5fa2dd/ffffff",
                "name"=> "libero",
                "code"=> "briny",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/177x100.png/cc0000/ffffff",
                "name"=> "morbi vestibulum velit",
                "code"=> "lower",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/185x100.png/cc0000/ffffff",
                "name"=> "tellus in sagittis",
                "code"=> "lucid",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/138x100.png/5fa2dd/ffffff",
                "name"=> "purus sit",
                "code"=> "smear",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/118x100.png/5fa2dd/ffffff",
                "name"=> "enim",
                "code"=> "meres",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/187x100.png/5fa2dd/ffffff",
                "name"=> "proin risus",
                "code"=> "shies",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/133x100.png/cc0000/ffffff",
                "name"=> "consequat varius",
                "code"=> "texts",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/113x100.png/cc0000/ffffff",
                "name"=> "in faucibus orci",
                "code"=> "jerky",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/143x100.png/cc0000/ffffff",
                "name"=> "dapibus nulla",
                "code"=> "fumes",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/118x100.png/dddddd/000000",
                "name"=> "pellentesque",
                "code"=> "dew's",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/164x100.png/dddddd/000000",
                "name"=> "nascetur ridiculus",
                "code"=> "silly",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/236x100.png/ff4444/ffffff",
                "name"=> "fusce",
                "code"=> "again",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/152x100.png/cc0000/ffffff",
                "name"=> "velit eu est",
                "code"=> "hinge",
                "description"=> "Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/108x100.png/5fa2dd/ffffff",
                "name"=> "dui vel",
                "code"=> "basil",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.\n\nProin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/206x100.png/ff4444/ffffff",
                "name"=> "ac",
                "code"=> "pin's",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/238x100.png/ff4444/ffffff",
                "name"=> "odio curabitur convallis",
                "code"=> "lever",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/222x100.png/cc0000/ffffff",
                "name"=> "duis faucibus accumsan",
                "code"=> "arc's",
                "description"=> "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.\n\nIn sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/247x100.png/dddddd/000000",
                "name"=> "proin eu mi",
                "code"=> "tempt",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/237x100.png/ff4444/ffffff",
                "name"=> "velit",
                "code"=> "omega",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/237x100.png/ff4444/ffffff",
                "name"=> "ut suscipit",
                "code"=> "soaks",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/5fa2dd/ffffff",
                "name"=> "aenean sit amet",
                "code"=> "friar",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/106x100.png/dddddd/000000",
                "name"=> "ultrices",
                "code"=> "bleak",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.\n\nPellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/201x100.png/cc0000/ffffff",
                "name"=> "montes",
                "code"=> "needs",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.\n\nIn congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/140x100.png/dddddd/000000",
                "name"=> "sapien in sapien",
                "code"=> "fetus",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/105x100.png/dddddd/000000",
                "name"=> "nec",
                "code"=> "brute",
                "description"=> "Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/105x100.png/dddddd/000000",
                "name"=> "pede morbi",
                "code"=> "tee's",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.\n\nPraesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/164x100.png/cc0000/ffffff",
                "name"=> "interdum",
                "code"=> "poise",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/113x100.png/cc0000/ffffff",
                "name"=> "in lectus",
                "code"=> "flare",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/222x100.png/5fa2dd/ffffff",
                "name"=> "non interdum in",
                "code"=> "heave",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.\n\nMauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/210x100.png/5fa2dd/ffffff",
                "name"=> "consectetuer eget rutrum",
                "code"=> "typed",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/142x100.png/ff4444/ffffff",
                "name"=> "felis donec semper",
                "code"=> "spuds",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/138x100.png/cc0000/ffffff",
                "name"=> "sed",
                "code"=> "scabs",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/215x100.png/5fa2dd/ffffff",
                "name"=> "consequat nulla",
                "code"=> "ill's",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/202x100.png/5fa2dd/ffffff",
                "name"=> "risus praesent lectus",
                "code"=> "vague",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/248x100.png/5fa2dd/ffffff",
                "name"=> "in",
                "code"=> "echos",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/145x100.png/5fa2dd/ffffff",
                "name"=> "enim sit amet",
                "code"=> "touch",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/182x100.png/cc0000/ffffff",
                "name"=> "lorem ipsum",
                "code"=> "taped",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/230x100.png/dddddd/000000",
                "name"=> "vitae consectetuer",
                "code"=> "gonna",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/178x100.png/5fa2dd/ffffff",
                "name"=> "lobortis",
                "code"=> "dying",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.\n\nMauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/222x100.png/dddddd/000000",
                "name"=> "leo",
                "code"=> "dents",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/124x100.png/5fa2dd/ffffff",
                "name"=> "lorem quisque",
                "code"=> "fur's",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/141x100.png/5fa2dd/ffffff",
                "name"=> "amet sem",
                "code"=> "Latin",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/151x100.png/cc0000/ffffff",
                "name"=> "tortor sollicitudin mi",
                "code"=> "din's",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/194x100.png/dddddd/000000",
                "name"=> "nulla integer",
                "code"=> "nippy",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.\n\nCras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/138x100.png/dddddd/000000",
                "name"=> "eu pede",
                "code"=> "hobby",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/233x100.png/dddddd/000000",
                "name"=> "fusce consequat nulla",
                "code"=> "rakes",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.\n\nCras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/123x100.png/cc0000/ffffff",
                "name"=> "duis",
                "code"=> "lymph",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/197x100.png/ff4444/ffffff",
                "name"=> "dolor sit",
                "code"=> "spill",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/109x100.png/dddddd/000000",
                "name"=> "est donec",
                "code"=> "melon",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/197x100.png/dddddd/000000",
                "name"=> "augue",
                "code"=> "toast",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/184x100.png/dddddd/000000",
                "name"=> "dignissim vestibulum",
                "code"=> "rat's",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.\n\nPraesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/139x100.png/cc0000/ffffff",
                "name"=> "nisi vulputate nonummy",
                "code"=> "fails",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/208x100.png/dddddd/000000",
                "name"=> "posuere",
                "code"=> "eaten",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/128x100.png/dddddd/000000",
                "name"=> "felis fusce posuere",
                "code"=> "bones",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.\n\nPraesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/155x100.png/ff4444/ffffff",
                "name"=> "id",
                "code"=> "stove",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/147x100.png/dddddd/000000",
                "name"=> "turpis",
                "code"=> "hoots",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/125x100.png/ff4444/ffffff",
                "name"=> "phasellus",
                "code"=> "broth",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/135x100.png/ff4444/ffffff",
                "name"=> "tortor",
                "code"=> "helps",
                "description"=> "Phasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.\n\nProin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/162x100.png/5fa2dd/ffffff",
                "name"=> "imperdiet nullam orci",
                "code"=> "abode",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/171x100.png/cc0000/ffffff",
                "name"=> "integer",
                "code"=> "ninny",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/197x100.png/dddddd/000000",
                "name"=> "in",
                "code"=> "leg's",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/208x100.png/ff4444/ffffff",
                "name"=> "elementum",
                "code"=> "filmy",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/134x100.png/5fa2dd/ffffff",
                "name"=> "a ipsum integer",
                "code"=> "annex",
                "description"=> "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/140x100.png/5fa2dd/ffffff",
                "name"=> "ipsum dolor",
                "code"=> "truly",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/127x100.png/ff4444/ffffff",
                "name"=> "sapien",
                "code"=> "irked",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/179x100.png/dddddd/000000",
                "name"=> "in lacus curabitur",
                "code"=> "bored",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/212x100.png/dddddd/000000",
                "name"=> "tortor duis mattis",
                "code"=> "jacks",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/209x100.png/cc0000/ffffff",
                "name"=> "sit amet turpis",
                "code"=> "patio",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/241x100.png/ff4444/ffffff",
                "name"=> "at",
                "code"=> "spats",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/116x100.png/5fa2dd/ffffff",
                "name"=> "eros elementum",
                "code"=> "corks",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/227x100.png/dddddd/000000",
                "name"=> "erat",
                "code"=> "while",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/110x100.png/ff4444/ffffff",
                "name"=> "quis",
                "code"=> "combs",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/171x100.png/ff4444/ffffff",
                "name"=> "viverra",
                "code"=> "ditto",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/180x100.png/cc0000/ffffff",
                "name"=> "sed",
                "code"=> "proof",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/103x100.png/cc0000/ffffff",
                "name"=> "morbi non quam",
                "code"=> "moped",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/5fa2dd/ffffff",
                "name"=> "sed",
                "code"=> "dived",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/211x100.png/dddddd/000000",
                "name"=> "integer non velit",
                "code"=> "smack",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/ff4444/ffffff",
                "name"=> "sapien iaculis congue",
                "code"=> "inept",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/141x100.png/dddddd/000000",
                "name"=> "risus semper",
                "code"=> "chimp",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/139x100.png/ff4444/ffffff",
                "name"=> "et tempus",
                "code"=> "pined",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/207x100.png/dddddd/000000",
                "name"=> "ipsum aliquam non",
                "code"=> "booze",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/131x100.png/5fa2dd/ffffff",
                "name"=> "tortor sollicitudin mi",
                "code"=> "wrath",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/107x100.png/ff4444/ffffff",
                "name"=> "luctus et ultrices",
                "code"=> "buxom",
                "description"=> "Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.\n\nMauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/204x100.png/5fa2dd/ffffff",
                "name"=> "lectus",
                "code"=> "filch",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/225x100.png/5fa2dd/ffffff",
                "name"=> "molestie",
                "code"=> "sneak",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.\n\nAenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/169x100.png/5fa2dd/ffffff",
                "name"=> "curae duis faucibus",
                "code"=> "scene",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/191x100.png/dddddd/000000",
                "name"=> "integer non velit",
                "code"=> "pay's",
                "description"=> "Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/242x100.png/ff4444/ffffff",
                "name"=> "id",
                "code"=> "cheer",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/234x100.png/dddddd/000000",
                "name"=> "luctus cum sociis",
                "code"=> "locks",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/200x100.png/ff4444/ffffff",
                "name"=> "aenean auctor gravida",
                "code"=> "daily",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/120x100.png/ff4444/ffffff",
                "name"=> "integer a nibh",
                "code"=> "lowly",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.\n\nMaecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/186x100.png/cc0000/ffffff",
                "name"=> "ultrices enim",
                "code"=> "moose",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/225x100.png/dddddd/000000",
                "name"=> "convallis",
                "code"=> "sneer",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/214x100.png/dddddd/000000",
                "name"=> "justo etiam pretium",
                "code"=> "fixed",
                "description"=> "Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.\n\nQuisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/230x100.png/cc0000/ffffff",
                "name"=> "ut rhoncus aliquet",
                "code"=> "rasps",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/211x100.png/dddddd/000000",
                "name"=> "justo in",
                "code"=> "short",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/230x100.png/dddddd/000000",
                "name"=> "turpis donec posuere",
                "code"=> "gimme",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/149x100.png/cc0000/ffffff",
                "name"=> "eget massa",
                "code"=> "cog's",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/231x100.png/dddddd/000000",
                "name"=> "sed",
                "code"=> "aimed",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/240x100.png/ff4444/ffffff",
                "name"=> "curabitur convallis duis",
                "code"=> "amend",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.\n\nCras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/162x100.png/5fa2dd/ffffff",
                "name"=> "ridiculus mus",
                "code"=> "pry's",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/208x100.png/5fa2dd/ffffff",
                "name"=> "in",
                "code"=> "tower",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/115x100.png/5fa2dd/ffffff",
                "name"=> "pellentesque quisque",
                "code"=> "cream",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/194x100.png/ff4444/ffffff",
                "name"=> "maecenas ut",
                "code"=> "riser",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/204x100.png/dddddd/000000",
                "name"=> "condimentum neque sapien",
                "code"=> "fades",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/215x100.png/ff4444/ffffff",
                "name"=> "sem sed",
                "code"=> "damns",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/245x100.png/dddddd/000000",
                "name"=> "ridiculus",
                "code"=> "scent",
                "description"=> "Praesent id massa id nisl venenatis lacinia. Aenean sit amet justo. Morbi ut odio.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/100x100.png/cc0000/ffffff",
                "name"=> "lectus vestibulum",
                "code"=> "oiled",
                "description"=> "Sed ante. Vivamus tortor. Duis mattis egestas metus.\n\nAenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/207x100.png/ff4444/ffffff",
                "name"=> "pede ullamcorper",
                "code"=> "berry",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.\n\nCurabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/120x100.png/5fa2dd/ffffff",
                "name"=> "dui nec nisi",
                "code"=> "allay",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/137x100.png/ff4444/ffffff",
                "name"=> "potenti cras in",
                "code"=> "mug's",
                "description"=> "In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/182x100.png/ff4444/ffffff",
                "name"=> "id mauris",
                "code"=> "dices",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/237x100.png/ff4444/ffffff",
                "name"=> "etiam vel augue",
                "code"=> "zests",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/173x100.png/dddddd/000000",
                "name"=> "congue",
                "code"=> "bears",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/188x100.png/cc0000/ffffff",
                "name"=> "et",
                "code"=> "ethic",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/197x100.png/cc0000/ffffff",
                "name"=> "cursus",
                "code"=> "build",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/193x100.png/ff4444/ffffff",
                "name"=> "vestibulum",
                "code"=> "skits",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/151x100.png/ff4444/ffffff",
                "name"=> "habitasse",
                "code"=> "sprig",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.\n\nMaecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/220x100.png/5fa2dd/ffffff",
                "name"=> "maecenas leo odio",
                "code"=> "dries",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/112x100.png/5fa2dd/ffffff",
                "name"=> "vel",
                "code"=> "flute",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/204x100.png/dddddd/000000",
                "name"=> "in quis justo",
                "code"=> "beams",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.\n\nInteger tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/137x100.png/ff4444/ffffff",
                "name"=> "mi",
                "code"=> "famed",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/140x100.png/5fa2dd/ffffff",
                "name"=> "sed interdum",
                "code"=> "sagas",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/108x100.png/5fa2dd/ffffff",
                "name"=> "fusce",
                "code"=> "fifth",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.\n\nNullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/153x100.png/dddddd/000000",
                "name"=> "adipiscing elit proin",
                "code"=> "fetch",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/132x100.png/ff4444/ffffff",
                "name"=> "dolor quis odio",
                "code"=> "sacks",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/221x100.png/5fa2dd/ffffff",
                "name"=> "erat",
                "code"=> "texts",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.\n\nAenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/202x100.png/5fa2dd/ffffff",
                "name"=> "in imperdiet et",
                "code"=> "glory",
                "description"=> "Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/139x100.png/5fa2dd/ffffff",
                "name"=> "sed interdum",
                "code"=> "waltz",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\n\nEtiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/169x100.png/ff4444/ffffff",
                "name"=> "fringilla",
                "code"=> "spays",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/212x100.png/dddddd/000000",
                "name"=> "rhoncus aliquet pulvinar",
                "code"=> "petty",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/223x100.png/cc0000/ffffff",
                "name"=> "cursus",
                "code"=> "query",
                "description"=> "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.\n\nPraesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/174x100.png/5fa2dd/ffffff",
                "name"=> "erat",
                "code"=> "glued",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/210x100.png/5fa2dd/ffffff",
                "name"=> "pede",
                "code"=> "erect",
                "description"=> "Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet, sapien urna pretium nisl, ut volutpat sapien arcu sed augue. Aliquam erat volutpat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/210x100.png/dddddd/000000",
                "name"=> "dapibus duis",
                "code"=> "inlet",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/101x100.png/5fa2dd/ffffff",
                "name"=> "ut",
                "code"=> "GNP's",
                "description"=> "Maecenas ut massa quis augue luctus tincidunt. Nulla mollis molestie lorem. Quisque ut erat.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/161x100.png/dddddd/000000",
                "name"=> "quis tortor id",
                "code"=> "mousy",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/205x100.png/cc0000/ffffff",
                "name"=> "felis",
                "code"=> "berry",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/116x100.png/cc0000/ffffff",
                "name"=> "vivamus metus",
                "code"=> "hides",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/249x100.png/cc0000/ffffff",
                "name"=> "dictumst etiam",
                "code"=> "FBI's",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/150x100.png/5fa2dd/ffffff",
                "name"=> "ultrices",
                "code"=> "raked",
                "description"=> "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.\n\nVestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/140x100.png/ff4444/ffffff",
                "name"=> "dapibus dolor vel",
                "code"=> "auras",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/136x100.png/cc0000/ffffff",
                "name"=> "elementum eu",
                "code"=> "deify",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/155x100.png/dddddd/000000",
                "name"=> "consequat metus sapien",
                "code"=> "cells",
                "description"=> "Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.\n\nDuis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/113x100.png/5fa2dd/ffffff",
                "name"=> "quisque erat",
                "code"=> "gamma",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/208x100.png/5fa2dd/ffffff",
                "name"=> "pretium",
                "code"=> "slays",
                "description"=> "Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.\n\nIn hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/161x100.png/dddddd/000000",
                "name"=> "dolor",
                "code"=> "notes",
                "description"=> "Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.\n\nNullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/191x100.png/ff4444/ffffff",
                "name"=> "id turpis",
                "code"=> "cheap",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.\n\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/198x100.png/ff4444/ffffff",
                "name"=> "in felis donec",
                "code"=> "urn's",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/111x100.png/dddddd/000000",
                "name"=> "condimentum",
                "code"=> "shine",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.\n\nIn hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/129x100.png/5fa2dd/ffffff",
                "name"=> "et tempus",
                "code"=> "flags",
                "description"=> "Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.\n\nMorbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/122x100.png/cc0000/ffffff",
                "name"=> "volutpat erat",
                "code"=> "putts",
                "description"=> "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.\n\nIn sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/207x100.png/5fa2dd/ffffff",
                "name"=> "imperdiet sapien",
                "code"=> "boast",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/189x100.png/dddddd/000000",
                "name"=> "potenti",
                "code"=> "extra",
                "description"=> "Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.\n\nFusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/250x100.png/dddddd/000000",
                "name"=> "morbi sem",
                "code"=> "hazel",
                "description"=> "Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/167x100.png/dddddd/000000",
                "name"=> "id ligula",
                "code"=> "snots",
                "description"=> "Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.\n\nQuisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/160x100.png/dddddd/000000",
                "name"=> "sapien varius ut",
                "code"=> "kited",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/184x100.png/cc0000/ffffff",
                "name"=> "non mattis",
                "code"=> "filed",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/250x100.png/ff4444/ffffff",
                "name"=> "eu massa",
                "code"=> "glory",
                "description"=> "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/186x100.png/5fa2dd/ffffff",
                "name"=> "vivamus metus arcu",
                "code"=> "fizzy",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/170x100.png/ff4444/ffffff",
                "name"=> "vitae nisl aenean",
                "code"=> "moron",
                "description"=> "Fusce consequat. Nulla nisl. Nunc nisl.\n\nDuis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/131x100.png/ff4444/ffffff",
                "name"=> "mauris non ligula",
                "code"=> "walks",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/159x100.png/dddddd/000000",
                "name"=> "quis turpis",
                "code"=> "lunar",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.\n\nPellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/212x100.png/cc0000/ffffff",
                "name"=> "vestibulum ante ipsum",
                "code"=> "frisk",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/170x100.png/ff4444/ffffff",
                "name"=> "lorem vitae mattis",
                "code"=> "psych",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/234x100.png/dddddd/000000",
                "name"=> "lorem",
                "code"=> "looks",
                "description"=> "Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.\n\nCurabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/193x100.png/ff4444/ffffff",
                "name"=> "ipsum dolor sit",
                "code"=> "fangs",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/162x100.png/cc0000/ffffff",
                "name"=> "quis augue luctus",
                "code"=> "pints",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/107x100.png/cc0000/ffffff",
                "name"=> "justo nec condimentum",
                "code"=> "mangy",
                "description"=> "In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.\n\nNulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/250x100.png/dddddd/000000",
                "name"=> "tristique est et",
                "code"=> "jut's",
                "description"=> "Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.\n\nDonec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/165x100.png/dddddd/000000",
                "name"=> "turpis",
                "code"=> "cured",
                "description"=> "Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.\n\nNam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/218x100.png/cc0000/ffffff",
                "name"=> "et ultrices posuere",
                "code"=> "drums",
                "description"=> "Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.\n\nIn sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/163x100.png/dddddd/000000",
                "name"=> "feugiat non pretium",
                "code"=> "wrong",
                "description"=> "Proin leo odio, porttitor id, consequat in, consequat ut, nulla. Sed accumsan felis. Ut at dolor quis odio consequat varius.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/239x100.png/cc0000/ffffff",
                "name"=> "consequat",
                "code"=> "glint",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/153x100.png/dddddd/000000",
                "name"=> "tincidunt",
                "code"=> "erect",
                "description"=> "Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.\n\nPhasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/115x100.png/ff4444/ffffff",
                "name"=> "convallis morbi odio",
                "code"=> "suave",
                "description"=> "Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.\n\nDuis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/243x100.png/cc0000/ffffff",
                "name"=> "ut",
                "code"=> "spark",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.\n\nSed ante. Vivamus tortor. Duis mattis egestas metus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/219x100.png/dddddd/000000",
                "name"=> "quisque ut erat",
                "code"=> "dryly",
                "description"=> "Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.\n\nInteger tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/191x100.png/ff4444/ffffff",
                "name"=> "nulla justo",
                "code"=> "china",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/132x100.png/ff4444/ffffff",
                "name"=> "in felis",
                "code"=> "clean",
                "description"=> "In congue. Etiam justo. Etiam pretium iaculis justo.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/149x100.png/cc0000/ffffff",
                "name"=> "ac lobortis",
                "code"=> "trawl",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\n\nEtiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/149x100.png/5fa2dd/ffffff",
                "name"=> "vel augue",
                "code"=> "zeros",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/138x100.png/dddddd/000000",
                "name"=> "turpis",
                "code"=> "guest",
                "description"=> "In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.\n\nAliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/220x100.png/5fa2dd/ffffff",
                "name"=> "consequat in consequat",
                "code"=> "stabs",
                "description"=> "Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/164x100.png/cc0000/ffffff",
                "name"=> "sapien a libero",
                "code"=> "madly",
                "description"=> "Fusce posuere felis sed lacus. Morbi sem mauris, laoreet ut, rhoncus aliquet, pulvinar sed, nisl. Nunc rhoncus dui vel sem.\n\nSed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/242x100.png/5fa2dd/ffffff",
                "name"=> "interdum eu",
                "code"=> "fords",
                "description"=> "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh.\n\nIn quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/166x100.png/dddddd/000000",
                "name"=> "eleifend",
                "code"=> "heart",
                "description"=> "Phasellus in felis. Donec semper sapien a libero. Nam dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/145x100.png/ff4444/ffffff",
                "name"=> "vel",
                "code"=> "baste",
                "description"=> "Mauris enim leo, rhoncus sed, vestibulum sit amet, cursus id, turpis. Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/119x100.png/5fa2dd/ffffff",
                "name"=> "magna at",
                "code"=> "float",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/142x100.png/cc0000/ffffff",
                "name"=> "quis",
                "code"=> "lilac",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.\n\nCurabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/162x100.png/5fa2dd/ffffff",
                "name"=> "in",
                "code"=> "helps",
                "description"=> "Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/221x100.png/5fa2dd/ffffff",
                "name"=> "praesent lectus vestibulum",
                "code"=> "chapt",
                "description"=> "Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/179x100.png/dddddd/000000",
                "name"=> "quis justo",
                "code"=> "wager",
                "description"=> "Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/143x100.png/ff4444/ffffff",
                "name"=> "curae",
                "code"=> "graze",
                "description"=> "Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo. Maecenas pulvinar lobortis est.\n\nPhasellus sit amet erat. Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/111x100.png/cc0000/ffffff",
                "name"=> "libero ut massa",
                "code"=> "wrist",
                "description"=> "In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.\n\nMaecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/134x100.png/cc0000/ffffff",
                "name"=> "cursus",
                "code"=> "fun's",
                "description"=> "Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/157x100.png/5fa2dd/ffffff",
                "name"=> "sit amet sem",
                "code"=> "honey",
                "description"=> "Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.\n\nFusce consequat. Nulla nisl. Nunc nisl.",
                "has_lab"=> false
            ],
            [
                "image"=> "http=>//dummyimage.com/178x100.png/5fa2dd/ffffff",
                "name"=> "quis lectus",
                "code"=> "stony",
                "description"=> "Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/156x100.png/5fa2dd/ffffff",
                "name"=> "adipiscing elit",
                "code"=> "berry",
                "description"=> "Etiam vel augue. Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/148x100.png/ff4444/ffffff",
                "name"=> "dolor sit",
                "code"=> "glean",
                "description"=> "Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/168x100.png/cc0000/ffffff",
                "name"=> "est quam pharetra",
                "code"=> "river",
                "description"=> "Sed sagittis. Nam congue, risus semper porta volutpat, quam pede lobortis ligula, sit amet eleifend pede libero quis orci. Nullam molestie nibh in lectus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/238x100.png/cc0000/ffffff",
                "name"=> "natoque",
                "code"=> "cites",
                "description"=> "Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
                "has_lab"=> true
            ],
            [
                "image"=> "http=>//dummyimage.com/163x100.png/cc0000/ffffff",
                "name"=> "morbi odio odio",
                "code"=> "brand",
                "description"=> "Proin eu mi. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.\n\nDuis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.",
                "has_lab"=> true
            ]
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}

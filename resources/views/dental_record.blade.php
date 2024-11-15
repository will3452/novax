{{-- @extends('layouts.app')

@section('content')
    <div class="container mt-4">

    </div>

@endsection --}}
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="space-y-2 relative">
        <div class="text-center">
            <div class="font-bold text-md uppercase">
                Joyce Dental Spa Clinic
            </div>
            <div class="text-xs">
                <div>
                    2nd Floor Big Ben Complex
                </div>
                <div>
                    JP Laurel Highway, Lipa City
                </div>
            </div>
        </div>
        <div class="text-center uppercase font-bold mx-auto text-xs">
            <span class="bg-gray-200 p-1 px-4 rounded-full inline-block">Dental Record Chart</span>
        </div>
        <div class="grid grid-cols-2 text-xs">
            <div class="font-bold">
                INTRAORAL EXAMINATION
            </div>
            <div>
                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-2">
                        Name:
                    </div>
                    <div class="col-span-10 border-b-2 border-gray-900 text-center">
                        {{$user->name}}
                    </div>
                    <div class="col-span-2">
                        Age:
                    </div>
                    <div class="col-span-2 border-b-2 border-gray-900 text-center">
                        {{$user->birthday ? $user->birthday->age : 'N/a'}}
                    </div>
                    <div class="col-span-2">
                        Gender:
                    </div>
                    <div class="col-span-2 border-b-2 border-gray-900 text-center">
                        {{$user->gender}}
                    </div>
                    <div class="col-span-2">
                        Date:
                    </div>
                    <div class="col-span-2 border-b-2 border-gray-900 text-center">
                        {{ now()->format('m/d/Y')}}
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center font-bold">
            DENTITION STATUS AND TREATMENT NEEDS
        </div>
        <div class="relative">
            <div class="uppercase -rotate-90 absolute left-16 top-[200px] text-xs">permanent teeth</div>
            <div class="uppercase absolute left-20 top-[305px] w-[50px] text-[8px]">Treatment Needs</div>
            <div class="flex justify-center items-center">
                <div class="w-[90px] text-xs">STATUS</div>
                <x-box>{{implode("", $user->getStatus(55))}}</x-box>
                <x-box>{{implode("", $user->getStatus(54))}}</x-box>
                <x-box>{{implode("", $user->getStatus(53))}}</x-box>
                <x-box>{{implode("", $user->getStatus(52))}}</x-box>
                <x-box>{{implode("", $user->getStatus(51))}}</x-box>
                <x-box>{{implode("", $user->getStatus(61))}}</x-box>
                <x-box>{{implode("", $user->getStatus(62))}}</x-box>
                <x-box>{{implode("", $user->getStatus(63))}}</x-box>
                <x-box>{{implode("", $user->getStatus(64))}}</x-box>
                <x-box>{{implode("", $user->getStatus(65))}}</x-box>
                <div class="w-[90px]"></div>
            </div>
            <div class="flex justify-center items-center">
                <div class="w-[90px] text-xs">RIGHT</div>
                <x-box>55</x-box>
                <x-box>54</x-box>
                <x-box>53</x-box>
                <x-box>52</x-box>
                <x-box>51</x-box>
                <x-box>61</x-box>
                <x-box>62</x-box>
                <x-box>63</x-box>
                <x-box>64</x-box>
                <x-box>65</x-box>
                <div class="w-[90px] text-center text-xs">LEFT</div>
            </div>
            <div class="flex justify-center items-center">
                <div class="w-[90px] text-[10px]">Temporary Teeth</div>
                <x-circle :filled="$user->hasFilled(55)"></x-circle>
                <x-circle :filled="$user->hasFilled(54)"></x-circle>
                <x-cross></x-cross>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross></x-cross>
                <x-circle :filled="$user->hasFilled(64)"></x-circle>
                <x-circle :filled="$user->hasFilled(65)"></x-circle>
                <div class="w-[90px]"></div>
            </div>
            <div class="flex justify-center items-center">
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
            </div>
            <div class="flex justify-center items-center">
                <x-box>{{implode("", $user->getStatus(18))}}</x-box>
                <x-box>{{implode("", $user->getStatus(17))}}</x-box>
                <x-box>{{implode("", $user->getStatus(16))}}</x-box>
                <x-box>{{implode("", $user->getStatus(15))}}</x-box>
                <x-box>{{implode("", $user->getStatus(14))}}</x-box>
                <x-box>{{implode("", $user->getStatus(13))}}</x-box>
                <x-box>{{implode("", $user->getStatus(12))}}</x-box>
                <x-box>{{implode("", $user->getStatus(11))}}</x-box>
                <x-box>{{implode("", $user->getStatus(21))}}</x-box>
                <x-box>{{implode("", $user->getStatus(22))}}</x-box>
                <x-box>{{implode("", $user->getStatus(23))}}</x-box>
                <x-box>{{implode("", $user->getStatus(24))}}</x-box>
                <x-box>{{implode("", $user->getStatus(25))}}</x-box>
                <x-box>{{implode("", $user->getStatus(26))}}</x-box>
                <x-box>{{implode("", $user->getStatus(27))}}</x-box>
                <x-box>{{implode("", $user->getStatus(28))}}</x-box>
            </div>
            <div class="flex justify-center items-center">
                <x-box>18</x-box>
                <x-box>17</x-box>
                <x-box>16</x-box>
                <x-box>15</x-box>
                <x-box>14</x-box>
                <x-box>13</x-box>
                <x-box>12</x-box>
                <x-box>11</x-box>
                <x-box>21</x-box>
                <x-box>22</x-box>
                <x-box>23</x-box>
                <x-box>24</x-box>
                <x-box>25</x-box>
                <x-box>26</x-box>
                <x-box>27</x-box>
                <x-box>28</x-box>
            </div>
            <div class="flex justify-center items-center">
                <x-circle :filled="$user->hasFilled(18)"></x-circle>
                <x-circle :filled="$user->hasFilled(17)"></x-circle>
                <x-circle :filled="$user->hasFilled(16)"></x-circle>
                <x-oval></x-oval>
                <x-oval></x-oval>
                <x-cross></x-cross>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross></x-cross>
                <x-oval></x-oval>
                <x-oval></x-oval>
                <x-circle :filled="$user->hasFilled(26)"></x-circle>
                <x-circle :filled="$user->hasFilled(27)"></x-circle>
                <x-circle :filled="$user->hasFilled(28)"></x-circle>
            </div>
            <div class="flex justify-center items-center">
                <x-circle :filled="$user->hasFilled(48)"></x-circle>
                <x-circle :filled="$user->hasFilled(47)"></x-circle>
                <x-circle :filled="$user->hasFilled(46)"></x-circle>
                <x-oval></x-oval>
                <x-oval></x-oval>
                <x-cross></x-cross>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross></x-cross>
                <x-oval></x-oval>
                <x-oval></x-oval>
                <x-circle :filled="$user->hasFilled(36)"></x-circle>
                <x-circle :filled="$user->hasFilled(37)"></x-circle>
                <x-circle :filled="$user->hasFilled(38)"></x-circle>
            </div>
            <div class="flex justify-center items-center">
                <x-box>48</x-box>
                <x-box>47</x-box>
                <x-box>46</x-box>
                <x-box>45</x-box>
                <x-box>44</x-box>
                <x-box>43</x-box>
                <x-box>42</x-box>
                <x-box>41</x-box>
                <x-box>31</x-box>
                <x-box>32</x-box>
                <x-box>33</x-box>
                <x-box>34</x-box>
                <x-box>35</x-box>
                <x-box>36</x-box>
                <x-box>37</x-box>
                <x-box>38</x-box>
            </div>
            <div class="flex justify-center items-center">
                <x-box>{{implode("", $user->getStatus(48))}}</x-box>
                <x-box>{{implode("", $user->getStatus(47))}}</x-box>
                <x-box>{{implode("", $user->getStatus(46))}}</x-box>
                <x-box>{{implode("", $user->getStatus(45))}}</x-box>
                <x-box>{{implode("", $user->getStatus(44))}}</x-box>
                <x-box>{{implode("", $user->getStatus(43))}}</x-box>
                <x-box>{{implode("", $user->getStatus(42))}}</x-box>
                <x-box>{{implode("", $user->getStatus(41))}}</x-box>
                <x-box>{{implode("", $user->getStatus(31))}}</x-box>
                <x-box>{{implode("", $user->getStatus(32))}}</x-box>
                <x-box>{{implode("", $user->getStatus(33))}}</x-box>
                <x-box>{{implode("", $user->getStatus(34))}}</x-box>
                <x-box>{{implode("", $user->getStatus(35))}}</x-box>
                <x-box>{{implode("", $user->getStatus(36))}}</x-box>
                <x-box>{{implode("", $user->getStatus(37))}}</x-box>
                <x-box>{{implode("", $user->getStatus(38))}}</x-box>
            </div>
            <div class="flex justify-center items-center">
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
                <x-box></x-box>
            </div>
            <div class="flex justify-center items-center">
                <div class="w-[90px] text-[10px]">Temporary Teeth</div>
                <x-circle></x-circle>
                <x-circle></x-circle>
                <x-cross></x-cross>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross2></x-cross2>
                <x-cross></x-cross>
                <x-circle></x-circle>
                <x-circle></x-circle>
                <div class="w-[90px]"></div>
            </div>
            <div class="flex justify-center items-center">
                <div class="w-[90px] text-xs">RIGHT</div>
                <x-box>85</x-box>
                <x-box>84</x-box>
                <x-box>83</x-box>
                <x-box>82</x-box>
                <x-box>81</x-box>
                <x-box>71</x-box>
                <x-box>72</x-box>
                <x-box>73</x-box>
                <x-box>74</x-box>
                <x-box>75</x-box>
                <div class="w-[90px] text-center text-xs">LEFT</div>
            </div>
            <div class="flex justify-center items-center">
                <div class="w-[90px] text-xs">STATUS</div>
                <x-box>{{implode("", $user->getStatus(85))}}</x-box>
                <x-box>{{implode("", $user->getStatus(84))}}</x-box>
                <x-box>{{implode("", $user->getStatus(83))}}</x-box>
                <x-box>{{implode("", $user->getStatus(82))}}</x-box>
                <x-box>{{implode("", $user->getStatus(81))}}</x-box>
                <x-box>{{implode("", $user->getStatus(71))}}</x-box>
                <x-box>{{implode("", $user->getStatus(72))}}</x-box>
                <x-box>{{implode("", $user->getStatus(73))}}</x-box>
                <x-box>{{implode("", $user->getStatus(74))}}</x-box>
                <x-box>{{implode("", $user->getStatus(75))}}</x-box>
                <div class="w-[90px]"></div>
            </div>
        </div>
        <div class="grid grid-cols-12">
            <div class="col-span-3 font-bold">
                Legend:
            </div>
            <div class="col-span-3 space-y-2">
                <div class="font-bold text-xs">Condition</div>
                <div class="text-[10px]">
                    <span class="font-bold">D</span> - Decayed (Caries Indicated for Filling)
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">M</span> - Missing
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">F</span> - Filled
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">I</span> - Caries Indicated for Extraction
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">RF</span> - Root Fragment
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">MO</span> - Missing due to Other Causes
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">Im</span> - Impacted Tooth
                </div>
            </div>

            <div class="col-span-3 space-y-2">
                <div class="font-bold text-xs">Restoration & Prosthetics</div>
                <div class="text-[10px]">
                    <span class="font-bold">J</span> - Jacket Crown
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">A</span> - Almagam Filling
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">AB</span> - Abutment
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">P</span> - Pontic
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">In</span> - Inlay
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">Fx</span> - Fixed Cure Composite
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">S</span> - Sealants
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">Rm</span> - Removable Denture
                </div>
            </div>
            <div class="col-span-3 space-y-2">
                <div class="font-bold text-xs">Surgery</div>
                <div class="text-[10px]">
                    <span class="font-bold">X</span> - Extraction due to Caries
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">XO</span> - Extraction due to Other Caries
                </div>
                <div class="text-[10px]">
                    <span class="font-bold"> ✔</span> Others
                </div>
                <div class="pl-4 text-[10px]">
                    - Present Teeth
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">Cm</span> - Congenitally Missing
                </div>
                <div class="text-[10px]">
                    <span class="font-bold">Sp</span> - Supemumery
                </div>
            </div>
        </div>
        <div class="grid grid-cols-4 text-[10px]">
            <div>
                <div class="font-bold">
                    Periodontal Screening:
                </div>
                <div class="grid grid-cols-3">
                    <div cass="underlined">{{$user->dentalRecord->gingivitis ? '✔': ''}}</div>
                    <div class="col-span-2">Gingivitis</div>

                    <div cass="underlined">{{$user->dentalRecord->early ? '✔': ''}}</div>
                    <div class="col-span-2">Early Periodontitis</div>

                    <div cass="underlined">{{$user->dentalRecord->moderate ? '✔': ''}}</div>
                    <div class="col-span-2">Moderate Periodontitis</div>

                    <div cass="underlined">{{$user->dentalRecord->advance ? '✔': ''}}</div>
                    <div class="col-span-2">Advanced Periodontitis</div>
                </div>
            </div>
            <div>
                <div class="font-bold">
                    Occlusion:
                </div>
                <div class="grid grid-cols-3">
                    <div cass="underlined">{{$user->dentalRecord->class ? '✔': ''}}</div>
                    <div class="col-span-2">Class (Molar)</div>

                    <div cass="underlined">{{$user->dentalRecord->overjet ? '✔': ''}}</div>
                    <div class="col-span-2">Overjet</div>

                    <div cass="underlined">{{$user->dentalRecord->overbite ? '✔': ''}}</div>
                    <div class="col-span-2">Overbite</div>

                    <div cass="underlined">{{$user->dentalRecord->midline ? '✔': ''}}</div>
                    <div class="col-span-2">Midline Deviation</div>

                    <div cass="underlined">{{$user->dentalRecord->crossbite ? '✔': ''}}</div>
                    <div class="col-span-2">Crossbite</div>
                </div>
            </div>
            <div>
                <div class="font-bold">
                    Appliances:
                </div>
                <div class="grid grid-cols-3">
                    <div cass="underlined">{{$user->dentalRecord->ortho ? '✔': ''}}</div>
                    <div class="col-span-2">Orthodontic</div>

                    <div cass="underlined">{{$user->dentalRecord->stay ? '✔': ''}}</div>
                    <div class="col-span-2">Stayplate</div>

                    <div cass="underlined">{{$user->dentalRecord->others}}</div>
                    <div class="col-span-2">Others</div>
                </div>
            </div>
            <div>
                <div class="font-bold">
                    TMD:
                </div>
                <div class="grid grid-cols-3">
                    <div cass="underlined">{{$user->dentalRecord->clenching ? '✔': ''}}</div>
                    <div class="col-span-2">Clenching</div>

                    <div cass="underlined">{{$user->dentalRecord->clicking ? '✔': ''}}</div>
                    <div class="col-span-2">Clicking</div>

                    <div cass="underlined">{{$user->dentalRecord->tris ? '✔': ''}}</div>
                    <div class="col-span-2">Trismus</div>


                    <div cass="underlined">{{$user->dentalRecord->muscle ? '✔': ''}}</div>
                    <div class="col-span-2">Muscle Spasm</div>
                </div>
            </div>
        </div>
        <div class="text-right text-xs">
            <div>
                Prepared by:
            </div>
            <div class="font-bold">
                JOYCE LITAN IRIBANI DMD
            </div>
            <div>Dentist / Dental Clinic Owner</div>
        </div>
    </div>

    <script>
        window.print()
    </script>
</body>

<?php
$datos = $_POST["data"];
$xd = explode(",",$datos);
$lista = array();
$y=0;
for ($i=1; $i < (count($xd)/6)+1; $i++) { 
    $listtemp = array();
    for ($x=$y; $x < 6*$i; $x++) { 
        array_push($listtemp,$xd[$x]);
    }
    array_push($lista,$listtemp);
    $y=$x;
}
$url = __DIR__;
$url = substr($url,0,strpos($url,"\proformas"));

require $url."/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

$documento = new Spreadsheet();
$documento
    ->getProperties()
    ->setCreator("Junta de ahorros")
    ->setDescription("Proforma de prestamo");

$sheet = $documento->getActiveSheet();
$documento->getDefaultStyle()->getFont()->setName("Arial")->setSize(10);

$estilocabecera = [
    'font'=>[
        'color' =>[
            'rgb'=>'FFFFFF'
        ],
        'bold'=>true
    ],
    'fill'=>[
        'fillType'=>Fill::FILL_SOLID,
        'startColor'=>[
            'rgb'=>'00249C'
        ]
    ],
    'borders'=>[
        'bottom'=>[
            'borderStyle'=>Border::BORDER_THICK,
            'color'=> [
                'rgb'=>'FFFFFF'
            ]
        ]
    ]
];

$cabeceramenor = [
    'font'=>[
        'color'=>[
            'rgb'=>"FFFFFF"
        ],
        'bold'=>true,
        'size'=>12
    ],
    'fill'=>[
        'fillType'=>Fill::FILL_SOLID,
        'startColor'=>[
            'rgb'=>'00249C'
        ]
    ],
];

$negritanum=[
    'font' =>[
        'color'=>[
            'rgb'=>"0000000"
        ],
        'bold'=>true,
        'size'=>11
    ]
];

//anchos
$documento->getActiveSheet()->getColumnDimension("B")->setWidth(11);
$documento->getActiveSheet()->getColumnDimension("C")->setWidth(14);
$documento->getActiveSheet()->getColumnDimension("D")->setWidth(14);
$documento->getActiveSheet()->getColumnDimension("E")->setWidth(14);
$documento->getActiveSheet()->getColumnDimension("F")->setWidth(14);
$documento->getActiveSheet()->getColumnDimension("G")->setWidth(14);

//cabecera

$documento->getActiveSheet()->setCellValue("B3","Proforma de prestamo");
$documento->getActiveSheet()->mergeCells("B3:E3");
$documento->getActiveSheet()->getStyle("B3")->getFont()->setSize(20);
$documento->getActiveSheet()->getStyle("B3")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
$documento->getActiveSheet()->getStyle("B3:G3")->applyFromArray($estilocabecera);
$documento->getActiveSheet()->getRowDimension(3)->setRowHeight(40);

//Cabecera - titulos
$documento->getActiveSheet()
    ->setCellValue("B4","N°")
    ->setCellValue("C4","Fecha")
    ->setCellValue("D4","Saldo")
    ->setCellValue("E4","Amortiz.")
    ->setCellValue("F4","Interes")
    ->setCellValue("G4","Cuota");

$documento->getActiveSheet()->getRowDimension(4)->setRowHeight(22);
$documento->getActiveSheet()->getStyle("B4:G4")->applyFromArray($cabeceramenor);
$documento->getActiveSheet()->getStyle("B4:G4")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

//Cuerpo con la info
//Columnas afectadas
$letras = array("B","C","D","E","F","G");
$y=4;
//llenar filas
foreach ($lista as $prkey => $prval) {
    $y++;
    $x=0;
    //llenar columnas
    foreach ($prval as $sgkey => $sgval) {
        $x++;
        $documento->getActiveSheet()
        ->setCellValue($letras[$sgkey].$y,$sgval);
        if ($x>2) {
            $documento->getActiveSheet()->getStyle($letras[$sgkey].$y)->getNumberFormat()->applyFromArray([
                'formatCode'=> NumberFormat::FORMAT_CURRENCY_USD_SIMPLE
            ]);
        }
    }
    $documento->getActiveSheet()->getRowDimension($y)->setRowHeight(20);
    fmod($y,2) ? $color = "DCE6F1": $color="B8CFE4" ;
    $documento->getActiveSheet()->getStyle("B$y:G$y")->applyFromArray([
        'fill'=>[
            'fillType'=>Fill::FILL_SOLID,
            'startColor'=>[
                'rgb'=>$color
            ]
        ],
    ]);
}

//Bordes del cuerpo
$documento->getActiveSheet()->getStyle("B5:G$y")->applyFromArray([
    'borders'=>[
        'allBorders'=>[
            'borderStyle'=>Border::BORDER_THIN,
            'color'=>[
                'rgb'=>"000000"
            ]
        ]
    ]
]);

//Orientacion, llega hasta el footer
$documento->getActiveSheet()->getStyle("B5:G".($y+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$documento->getActiveSheet()->getStyle("B5:G".($y+1))->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

$documento->getActiveSheet()->getStyle("B5:B".$y)->applyFromArray($negritanum);

//Footer (Columnas que utilizare  : D , E , F)
    //Fondo
$documento->getActiveSheet()->getStyle("B".($y+1).":G".($y+1))->applyFromArray([
    'fill'=>[
        'fillType'=>Fill::FILL_SOLID,
        'startColor'=>[
            'rgb'=>'00249C'
        ]
    ],
    'font'=>[
        'color'=>[
            "rgb"=>"FFFFFF"
        ],
        "bold"=>true,
        "size"=>12
    ] 
]
);
    //Valores
$documento->getActiveSheet()->setCellValue("D".($y+1),"Total: ");
$documento->getActiveSheet()->setCellValue("E".($y+1),"=SUM(E6:E".$y.")");
$documento->getActiveSheet()->setCellValue("F".($y+1),"=SUM(F6:F".$y.")");
    //Tamaño
$documento->getActiveSheet()->getRowDimension(($y+1))->setRowHeight(23);

    //Estilos

$documento->getActiveSheet()->getStyle("D".($y+1))->applyFromArray([
    "font"=>[
            "bold"=>true
    ]
]);

$documento->getActiveSheet()->getStyle("E".($y+1))->applyFromArray([
    "font"=>[
        "bold" =>  true
    ] 
]);

$documento->getActiveSheet()->getStyle("F".($y+1))->applyFromArray([
    "font"=>[
        "bold"=>true
    ]
]);

    //Formatos
$documento->getActiveSheet()->getStyle("E".($y+1))->getNumberFormat()->applyFromArray([
    'formatCode'=> NumberFormat::FORMAT_CURRENCY_USD_SIMPLE
]);
$documento->getActiveSheet()->getStyle("F".($y+1))->getNumberFormat()->applyFromArray([
    'formatCode'=> NumberFormat::FORMAT_CURRENCY_USD_SIMPLE
]);

    //Orientacion 
$documento->getActiveSheet()->getStyle("D".($y+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

$nombreDelDocumento = "Proforma.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');
 
$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;
?>
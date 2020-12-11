<?php

namespace App\Controller;

use App\Classes\CommonFun;
use App\Concacts\SortConcact;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
class ExcelController extends BaseController
{
    /**
     * 导出excel
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    function export(){
        $data = [
            ['title1' => '111', 'title2' => '222'],
            ['title1' => '111', 'title2' => '222'],
            ['title1' => '111', 'title2' => '222']
        ];
        $title = ['第一行标题', '第二行标题'];

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 方法一，使用 setCellValueByColumnAndRow
        //表头
        //设置单元格内容
        foreach ($title as $key => $value) {
            // 单元格内容写入
            $sheet->setCellValueByColumnAndRow($key + 1, 1, $value);
        }
        $row = 2; // 从第二行开始
        foreach ($data as $item) {
            $column = 1;
            foreach ($item as $value) {
                // 单元格内容写入
                $sheet->setCellValueByColumnAndRow($column, $row, $value);
                $column++;
            }
            $row++;
        }

        // 方法二，使用 setCellValue
        //表头
        //设置单元格内容
        $titCol = 'A';
        foreach ($title as $key => $value) {
            // 单元格内容写入
            $sheet->setCellValue($titCol . '1', $value);
            $titCol++;
        }
        $row = 2; // 从第二行开始
        foreach ($data as $item) {
            $dataCol = 'A';
            foreach ($item as $value) {
                // 单元格内容写入
                $sheet->setCellValue($dataCol . $row, $value);
                $dataCol++;
            }
            $row++;
        }

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    /**
     * excel文件保存到本地
     */
    function save()
    {
        $data = [
            ['title1' => '111', 'title2' => '222'],
            ['title1' => '111', 'title2' => '222'],
            ['title1' => '111', 'title2' => '222']
        ];
        $title = ['第一行标题', '第二行标题'];

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //表头
        //设置单元格内容
        $titCol = 'A';
        foreach ($title as $key => $value) {
            // 单元格内容写入

            $sheet->setCellValue($titCol . '1', $value);

            $titCol++;
        }

        $row = 2; // 从第二行开始
        foreach ($data as $item) {
            $dataCol = 'A';
            foreach ($item as $value) {
                // 单元格内容写入
                $sheet->setCellValue($dataCol . $row, $value);
                $dataCol++;
            }

            $row++;

        }
        //设置列宽
        $sheet->getColumnDimension('A')->setWidth(30);
        //合并单元格
        $spreadsheet->getActiveSheet()->mergeCells('A1:B1');
        //将合并后的单元格拆分
        $spreadsheet->getActiveSheet()->unmergeCells('A1:B1');
        //将A1单元格设置为水平居中对齐。
        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
        //将A2至B2的区域添加红色边框。
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => 'FFFF0000'],
                ],
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A2:B2')->applyFromArray($styleArray);
        //设置当前工作表标题。
        $spreadsheet->getActiveSheet()->setTitle('Hello');
        $spreadsheet->getProperties()
            ->setCreator("Helloweba")    //作者
            ->setLastModifiedBy("Yuegg") //最后修改者
            ->setTitle("Hello")  //标题
            ->setSubject("Office 2007 XLSX Test Document") //副标题
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")  //描述
            ->setKeywords("office 2007 openxml php") //关键字
            ->setCategory("Test result file"); //分类
        // Save
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('01simple.xlsx');
    }

    /**
     * 读取excel文件内容
     */
    function read()
    {
        $inputFileName = dirname(__FILE__,3) . '/01simple.xlsx';
        $spreadsheet = IOFactory::load($inputFileName);
        // 方法二
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        var_dump($sheetData);
    }
}

<?php

    
    require __DIR__ . '/../libraries/PhpOffice/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    class ReportModel{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }


        public function getSalesMonth(){
            $this->db->query('SELECT DATE_FORMAT(invoice_date, \'%Y-%m\') AS month_year, SUM(total_amount) AS monthly_sales FROM petcare_shop_invoices GROUP BY DATE_FORMAT(invoice_date, \'%Y-%m\') ORDER BY DATE_FORMAT(invoice_date, \'%Y-%m\')');
            $results = $this->db->resultSet();
            return $results;
        }

        public function getSalesYear(){
            $this->db->query('SELECT DATE_FORMAT(invoice_date, \'%Y\') AS year, SUM(total_amount) AS yearly_sales FROM petcare_shop_invoices GROUP BY DATE_FORMAT(invoice_date, \'%Y\') ORDER BY DATE_FORMAT(invoice_date, \'%Y\')');
            $results = $this->db->resultSet();
            return $results;
        }

        public function getAppointmentRevenueMonth(){
            $this->db->query('SELECT DATE_FORMAT(appointment_date, \'%Y-%m\') AS month_year, SUM(price) AS monthly_revenue FROM petcare_appointments WHERE status != "Rejected" GROUP BY DATE_FORMAT(appointment_date, \'%Y-%m\') ORDER BY DATE_FORMAT(appointment_date, \'%Y-%m\')');
            $results = $this->db->resultSet();
            return $results;
        }

        public function getAppointmentRevenueYear(){
            $this->db->query('SELECT DATE_FORMAT(appointment_date, \'%Y\') AS year, SUM(price) AS yearly_revenue FROM petcare_appointments WHERE status != "Rejected" GROUP BY DATE_FORMAT(appointment_date, \'%Y\') ORDER BY DATE_FORMAT(appointment_date, \'%Y\')');
            $results = $this->db->resultSet();
            return $results;
        }

        public function getAnimalWardIncomeYear(){

            $this->db->query('SELECT YEAR(wt.payment_date) AS year, SUM(wm.price) AS yearly_revenue FROM petcare_ward_treatment wt JOIN petcare_ward_medical_bill wm ON wt.ward_treatment_id = wm.ward_treatment_id WHERE wt.payment_status = "Paid" GROUP BY YEAR(wt.payment_date) ORDER BY YEAR(wt.payment_date)');
            $results = $this->db->resultSet();
            return $results;

        }

        public function getAnimalWardIncomeMonth(){

            $this->db->query('SELECT DATE_FORMAT(wt.payment_date, \'%Y-%m\') AS month_year, SUM(wm.price) AS monthly_revenue FROM petcare_ward_treatment wt JOIN petcare_ward_medical_bill wm ON wt.ward_treatment_id = wm.ward_treatment_id WHERE wt.payment_status = "Paid" GROUP BY DATE_FORMAT(wt.payment_date, \'%Y-%m\') ORDER BY DATE_FORMAT(wt.payment_date, \'%Y-%m\')');
            $results = $this->db->resultSet();
            return $results;

        }

        public function getPetownerCountYear(){
            $this->db->query('SELECT DATE_FORMAT(register_date, \'%Y\') AS year, COUNT(*) AS petowner_count FROM petcare_petowner GROUP BY DATE_FORMAT(register_date, \'%Y\') ORDER BY DATE_FORMAT(register_date, \'%Y\')');
            $results = $this->db->resultSet();
            return $results;
        }

        public function getPetownerCountMonth(){
            $this->db->query('SELECT DATE_FORMAT(register_date, \'%Y-%m\') AS month_year, COUNT(*) AS petowner_count FROM petcare_petowner GROUP BY DATE_FORMAT(register_date, \'%Y-%m\') ORDER BY DATE_FORMAT(register_date, \'%Y-%m\')');
            $results = $this->db->resultSet();
            return $results;
        }

        public function getPopularProducts(){
            
            $this->db->query('  SELECT
                                    i.*,
                                    SUM(ci.quantity) AS total_quantity_ordered ,
                                    pc.categoryname AS product_category,
                                    i.id AS product_id,
                                    i.price AS product_price
                                FROM
                                    petcare_inventory i
                                JOIN
                                    petcare_cart_items ci ON i.id = ci.product_id
                                
                                JOIN
                                    petcare_product_category pc ON i.category = pc.id
                                GROUP BY
                                    i.id
                                ORDER BY
                                    total_quantity_ordered DESC;
                        
                            ');

        $results = $this->db->resultSet();
        return $results;
     }

     public function getShopingStatus(){
        $this->db->query('SELECT ship_status, COUNT(*) AS status_count FROM petcare_shop_invoices GROUP BY ship_status');
        $results = $this->db->resultSet();
        return $results;
     }

        public function downloadFullReport() {
            // Get appointment revenue data
            $appointmentsByMonth = $this->getAppointmentRevenueMonth();
            $appointmentByYear = $this->getAppointmentRevenueYear();

            //sales data
            $SalesMonth = $this->getSalesMonth();
            $SalesYear = $this->getSalesYear();
            $popularProducts = $this->getPopularProducts();
            $shopingStatus = $this->getShopingStatus();

            //animal ward income data
            $animalWardIncomeMonth = $this->getAnimalWardIncomeMonth();
            $animalWardIncomeYear = $this->getAnimalWardIncomeYear();

            //petowner count data
            $petownerCountYear = $this->getPetownerCountYear();
            $petownerCountMonth = $this->getPetownerCountMonth();
            
        
            // Create a new PhpSpreadsheet instance
            $spreadsheet = new Spreadsheet();
        
            // Set document properties
            $spreadsheet->getProperties()
                ->setCreator("PetCare:Admin User " . $_SESSION['user_fname'] . " " . $_SESSION['user_lname'])
                ->setTitle('PetCare Reports')
                ->setDescription('All Reports Generated by PetCare');

            // Set tab color
            $tabColorForAppointment = 'FF0000';
            $tabColorForSales = '00FF00';
            $tabColorForAnimalWardIncome = '0000FF';
            $tabColorForPetownerCount = 'FFFF00';

            /* ==================== Appointment ==================== */
        
            // Add a new sheet for the appointment revenue data
            $sheetAppointmentRevenue = $spreadsheet->getActiveSheet();
            // Specify the color in hexadecimal format (here, it's red)
            $sheetAppointmentRevenue->getTabColor()->setRgb($tabColorForAppointment);
            $sheetAppointmentRevenue->setTitle('Appointment Revenue Month');
        
            // Add column headers for appointment revenue data
            $sheetAppointmentRevenue->setCellValue('A1', 'Month/Year');
            $sheetAppointmentRevenue->setCellValue('B1', 'Monthly Revenue');
        
            // Populate data into the appointment revenue sheet
            $row = 2;
            foreach ($appointmentsByMonth as $appointment) {
                // Access object properties using object notation
                $sheetAppointmentRevenue->setCellValue('A' . $row, $appointment->month_year);
                $sheetAppointmentRevenue->setCellValue('B' . $row, $appointment->monthly_revenue);
                $row++;
            }

            //create new sheet for appointment revenue by year
            $sheetAppointmentRevenueYear = $spreadsheet->createSheet();
            $sheetAppointmentRevenueYear->getTabColor()->setRgb($tabColorForAppointment);
            $sheetAppointmentRevenueYear->setTitle('Appointment Revenue Year');

            // Add column headers for appointment revenue data
            $sheetAppointmentRevenueYear->setCellValue('A1', 'Year');
            $sheetAppointmentRevenueYear->setCellValue('B1', 'Yearly Revenue');

            // Populate data into the appointment revenue sheet
            $row = 2;
            foreach ($appointmentByYear as $appointment) {
                // Access object properties using object notation
                $sheetAppointmentRevenueYear->setCellValue('A' . $row, $appointment->year);
                $sheetAppointmentRevenueYear->setCellValue('B' . $row, $appointment->yearly_revenue);
                $row++;
            }


             /* ==================== Appointment Over ==================== */


            /* ==================== Sales ==================== */

            // Add a new sheet for the sales data
            $sheetSales = $spreadsheet->createSheet();
            // Specify the color in hexadecimal format (here, it's green)
            $sheetSales->getTabColor()->setRgb($tabColorForSales);
            $sheetSales->setTitle('Sales Month');

            // Add column headers for sales data
            $sheetSales->setCellValue('A1', 'Month/Year');
            $sheetSales->setCellValue('B1', 'Monthly Sales');

            // Populate data into the sales sheet
            $row = 2;

            foreach ($SalesMonth as $sales) {
                // Access object properties using object notation
                $sheetSales->setCellValue('A' . $row, $sales->month_year);
                $sheetSales->setCellValue('B' . $row, $sales->monthly_sales);
                $row++;
            }

            //create new sheet for sales by year

            $sheetSalesYear = $spreadsheet->createSheet();
            $sheetSalesYear->getTabColor()->setRgb($tabColorForSales);
            $sheetSalesYear->setTitle('Sales Year');

            // Add column headers for sales data
            $sheetSalesYear->setCellValue('A1', 'Year');
            $sheetSalesYear->setCellValue('B1', 'Yearly Sales');

            // Populate data into the sales sheet
            $row = 2;
            foreach ($SalesYear as $sales) {
                // Access object properties using object notation
                $sheetSalesYear->setCellValue('A' . $row, $sales->year);
                $sheetSalesYear->setCellValue('B' . $row, $sales->yearly_sales);
                $row++;
            }

            //create new sheet for popular products

            $sheetPopularProducts = $spreadsheet->createSheet();
            $sheetPopularProducts->getTabColor()->setRgb($tabColorForSales);
            $sheetPopularProducts->setTitle('Popular Products');

            // Add column headers for sales data
            $sheetPopularProducts->setCellValue('A1', 'Product ID');
            $sheetPopularProducts->setCellValue('B1', 'Product Name');
            $sheetPopularProducts->setCellValue('C1', 'Product Brand');
            $sheetPopularProducts->setCellValue('D1', 'Product Category');
            $sheetPopularProducts->setCellValue('E1', 'Product Current Stock');
            $sheetPopularProducts->setCellValue('F1', 'Total Quantity Ordered');
            $sheetPopularProducts->setCellValue('G1', 'Product Price');

            // Populate data into the sales sheet

            $row = 2;

            foreach ($popularProducts as $product) {
                // Access object properties using object notation
                $sheetPopularProducts->setCellValue('A' . $row, $product->product_id);
                $sheetPopularProducts->setCellValue('B' . $row, $product->name);
                $sheetPopularProducts->setCellValue('C' . $row, $product->brand);
                $sheetPopularProducts->setCellValue('D' . $row, $product->product_category);
                if($product->stock == 0){
                    //cell color red
                    $sheetPopularProducts->getStyle('E' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
                    $sheetPopularProducts->setCellValue('E' . $row, $product->stock);
                }elseif($product->stock < 10){
                    //cell color yellow
                    $sheetPopularProducts->getStyle('E' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
                    $sheetPopularProducts->setCellValue('E' . $row, $product->stock);
                }else{
                    $sheetPopularProducts->setCellValue('E' . $row, $product->stock);
                }
                $sheetPopularProducts->setCellValue('F' . $row, $product->total_quantity_ordered);
                $sheetPopularProducts->setCellValue('G' . $row, $product->product_price);
                $row++;
            }


            //create new sheet for shoping status

            $sheetShopingStatus = $spreadsheet->createSheet();
            $sheetShopingStatus->getTabColor()->setRgb($tabColorForSales);
            $sheetShopingStatus->setTitle('Shoping Status');

            // Add column headers for sales data
            $sheetShopingStatus->setCellValue('A1', 'Shipment Status');
            $sheetShopingStatus->setCellValue('B1', 'Status Count');

            // Populate data into the sales sheet

            $row = 2;

            foreach ($shopingStatus as $status) {
                // Access object properties using object notation
                $sheetShopingStatus->setCellValue('A' . $row, $status->ship_status);
                $sheetShopingStatus->setCellValue('B' . $row, $status->status_count);
                $row++;
            }

        
        /* ==================== Sales Over ==================== */


        /* ==================== Animal Ward Income ==================== */

        // Add a new sheet for the animal ward income data

        $sheetAnimalWardIncome = $spreadsheet->createSheet();
        // Specify the color in hexadecimal format (here, it's blue)
        $sheetAnimalWardIncome->getTabColor()->setRgb($tabColorForAnimalWardIncome);
        $sheetAnimalWardIncome->setTitle('Animal Ward Income Month');

        // Add column headers for animal ward income data
        $sheetAnimalWardIncome->setCellValue('A1', 'Month/Year');
        $sheetAnimalWardIncome->setCellValue('B1', 'Monthly Revenue');

        // Populate data into the animal ward income sheet
        $row = 2;
        foreach ($animalWardIncomeMonth as $wardIncome) {
            // Access object properties using object notation
            $sheetAnimalWardIncome->setCellValue('A' . $row, $wardIncome->month_year);
            $sheetAnimalWardIncome->setCellValue('B' . $row, $wardIncome->monthly_revenue);
            $row++;
        }

        //create new sheet for animal ward income by year

        $sheetAnimalWardIncomeYear = $spreadsheet->createSheet();
        $sheetAnimalWardIncomeYear->getTabColor()->setRgb($tabColorForAnimalWardIncome);
        $sheetAnimalWardIncomeYear->setTitle('Animal Ward Income Year');

        // Add column headers for animal ward income data

        $sheetAnimalWardIncomeYear->setCellValue('A1', 'Year');
        $sheetAnimalWardIncomeYear->setCellValue('B1', 'Yearly Revenue');

        // Populate data into the animal ward income sheet
        $row = 2;
        foreach ($animalWardIncomeYear as $wardIncome) {
            // Access object properties using object notation
            $sheetAnimalWardIncomeYear->setCellValue('A' . $row, $wardIncome->year);
            $sheetAnimalWardIncomeYear->setCellValue('B' . $row, $wardIncome->yearly_revenue);
            $row++;
        }

        /* ==================== Animal Ward Income Over ==================== */

        /* ==================== Petowner Count ==================== */

        // Add a new sheet for the petowner count data

        $sheetPetownerCount = $spreadsheet->createSheet();
        // Specify the color in hexadecimal format (here, it's yellow)

        $sheetPetownerCount->getTabColor()->setRgb($tabColorForPetownerCount);
        $sheetPetownerCount->setTitle('Petowner Count Month');

        // Add column headers for petowner count data
        $sheetPetownerCount->setCellValue('A1', 'Month/Year');
        $sheetPetownerCount->setCellValue('B1', 'Petowner Count');

        // Populate data into the petowner count sheet

        $row = 2;
        foreach ($petownerCountMonth as $petownerCount) {
            // Access object properties using object notation
            $sheetPetownerCount->setCellValue('A' . $row, $petownerCount->month_year);
            $sheetPetownerCount->setCellValue('B' . $row, $petownerCount->petowner_count);
            $row++;
        }

        //create new sheet for petowner count by year

        $sheetPetownerCountYear = $spreadsheet->createSheet();
        $sheetPetownerCountYear->getTabColor()->setRgb($tabColorForPetownerCount);
        $sheetPetownerCountYear->setTitle('Petowner Count Year');

        // Add column headers for petowner count data

        $sheetPetownerCountYear->setCellValue('A1', 'Year');
        $sheetPetownerCountYear->setCellValue('B1', 'Petowner Count');

        // Populate data into the petowner count sheet
        $row = 2;
        foreach ($petownerCountYear as $petownerCount) {
            // Access object properties using object notation
            $sheetPetownerCountYear->setCellValue('A' . $row, $petownerCount->year);
            $sheetPetownerCountYear->setCellValue('B' . $row, $petownerCount->petowner_count);
            $row++;
        }

        /* ==================== Petowner Count Over ==================== */
            
            //timestamp
            $timestamp = date('Y-m-d H:i:s');
            //formated timestamp
            $timestamp = str_replace(":", "-", $timestamp);

            // Set headers for a xls file
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="PetCare_Report_.'.$timestamp.'.xls"');
            header('Cache-Control: max-age=0');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save('php://output');
        }
        

        

        

}
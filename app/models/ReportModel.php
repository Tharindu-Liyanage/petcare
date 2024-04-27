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

        public function getAppointmentAllStatusByMonth(){
            $this->db->query('SELECT DATE_FORMAT(appointment_date, \'%Y-%m\') AS month_year, SUM(CASE WHEN status = "Completed" THEN 1 ELSE 0 END) AS completed_appointments, SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) AS pending_appointments, SUM(CASE WHEN status = "Rejected" THEN 1 ELSE 0 END) AS rejected_appointments, SUM(CASE WHEN status = "Confirmed" THEN 1 ELSE 0 END) AS confirmed_appointments, COUNT(*) AS total_appointments FROM petcare_appointments GROUP BY DATE_FORMAT(appointment_date, \'%Y-%m\') ORDER BY DATE_FORMAT(appointment_date, \'%Y-%m\')');
            $results = $this->db->resultSet();
            return $results;
            
        }

        public function getAppointmentAllStatusByYear(){
            $this->db->query('SELECT DATE_FORMAT(appointment_date, \'%Y\') AS year, SUM(CASE WHEN status = "Completed" THEN 1 ELSE 0 END) AS completed_appointments, SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) AS pending_appointments, SUM(CASE WHEN status = "Rejected" THEN 1 ELSE 0 END) AS rejected_appointments, SUM(CASE WHEN status = "Confirmed" THEN 1 ELSE 0 END) AS confirmed_appointments, COUNT(*) AS total_appointments FROM petcare_appointments GROUP BY DATE_FORMAT(appointment_date, \'%Y\') ORDER BY DATE_FORMAT(appointment_date, \'%Y\')');
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

     public function getShopingStatusByMonth(){
        $this->db->query('SELECT DATE_FORMAT(invoice_date, \'%Y-%m\') AS month_year, SUM(CASE WHEN ship_status = "On-Process" THEN 1 ELSE 0 END) AS on_process_count, SUM(CASE WHEN ship_status = "Shipped" THEN 1 ELSE 0 END) AS shipped_count, COUNT(*) AS total_orders, GROUP_CONCAT(invoice_id) AS invoice_id FROM petcare_shop_invoices GROUP BY DATE_FORMAT(invoice_date, \'%Y-%m\') ORDER BY DATE_FORMAT(invoice_date, \'%Y-%m\')');
        $results = $this->db->resultSet();
        return $results;   
     }



        public function downloadFullReport() {
            // Get appointment revenue data
            $appointmentsByMonth = $this->getAppointmentRevenueMonth();
            $appointmentByYear = $this->getAppointmentRevenueYear();
            $appointmentsAllStatusByMonth = $this->getAppointmentAllStatusByMonth();
            $appointmentsAllStatusByYear = $this->getAppointmentAllStatusByYear();

            //sales data
            $SalesMonth = $this->getSalesMonth();
            $SalesYear = $this->getSalesYear();
            $popularProducts = $this->getPopularProducts();
            $shopingStatus = $this->getShopingStatusByMonth();

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
          
            $sheetAppointmentRevenue->getColumnDimension('A')->setAutoSize(true);
            $sheetAppointmentRevenue->getColumnDimension('B')->setAutoSize(true);

        
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

            $sheetAppointmentRevenueYear->getColumnDimension('A')->setAutoSize(true);
            $sheetAppointmentRevenueYear->getColumnDimension('B')->setAutoSize(true);

            // Populate data into the appointment revenue sheet
            $row = 2;
            foreach ($appointmentByYear as $appointment) {
                // Access object properties using object notation
                $sheetAppointmentRevenueYear->setCellValue('A' . $row, $appointment->year);
                $sheetAppointmentRevenueYear->setCellValue('B' . $row, $appointment->yearly_revenue);
                $row++;
            }


            //create new sheet for appointment status

            $sheetAppointmentStatus = $spreadsheet->createSheet();
            $sheetAppointmentStatus->getTabColor()->setRgb($tabColorForAppointment);
            $sheetAppointmentStatus->setTitle('Appointment Status Month');

            // Add column headers for appointment status data

            $sheetAppointmentStatus->setCellValue('A1', 'Month/Year');
            $sheetAppointmentStatus->setCellValue('B1', 'Completed Appointments');
            $sheetAppointmentStatus->setCellValue('C1', 'Pending Appointments');
            $sheetAppointmentStatus->setCellValue('D1', 'Rejected Appointments');
            $sheetAppointmentStatus->setCellValue('E1', 'Confirmed Appointments');
            $sheetAppointmentStatus->setCellValue('F1', 'Total Appointments');

            $sheetAppointmentStatus->getColumnDimension('A')->setAutoSize(true);
            $sheetAppointmentStatus->getColumnDimension('B')->setAutoSize(true);
            $sheetAppointmentStatus->getColumnDimension('C')->setAutoSize(true);
            $sheetAppointmentStatus->getColumnDimension('D')->setAutoSize(true);
            $sheetAppointmentStatus->getColumnDimension('E')->setAutoSize(true);
            $sheetAppointmentStatus->getColumnDimension('F')->setAutoSize(true);

            // Populate data into the appointment status sheet

            $row = 2;

            foreach ($appointmentsAllStatusByMonth as $appointment) {
                // Access object properties using object notation
                $sheetAppointmentStatus->setCellValue('A' . $row, $appointment->month_year);
                $sheetAppointmentStatus->setCellValue('B' . $row, $appointment->completed_appointments);
                $sheetAppointmentStatus->setCellValue('C' . $row, $appointment->pending_appointments);
                $sheetAppointmentStatus->setCellValue('D' . $row, $appointment->rejected_appointments);
                $sheetAppointmentStatus->setCellValue('E' . $row, $appointment->confirmed_appointments);
                $sheetAppointmentStatus->setCellValue('F' . $row, $appointment->total_appointments);
                $row++;
            }


            //create new sheet for appointment status by year

            $sheetAppointmentStatusYear = $spreadsheet->createSheet();
            $sheetAppointmentStatusYear->getTabColor()->setRgb($tabColorForAppointment);
            $sheetAppointmentStatusYear->setTitle('Appointment Status Year');

            // Add column headers for appointment status data

            $sheetAppointmentStatusYear->setCellValue('A1', 'Year');
            $sheetAppointmentStatusYear->setCellValue('B1', 'Completed Appointments');
            $sheetAppointmentStatusYear->setCellValue('C1', 'Pending Appointments');
            $sheetAppointmentStatusYear->setCellValue('D1', 'Rejected Appointments');
            $sheetAppointmentStatusYear->setCellValue('E1', 'Confirmed Appointments');
            $sheetAppointmentStatusYear->setCellValue('F1', 'Total Appointments');

            $sheetAppointmentStatusYear->getColumnDimension('A')->setAutoSize(true);
            $sheetAppointmentStatusYear->getColumnDimension('B')->setAutoSize(true);
            $sheetAppointmentStatusYear->getColumnDimension('C')->setAutoSize(true);
            $sheetAppointmentStatusYear->getColumnDimension('D')->setAutoSize(true);
            $sheetAppointmentStatusYear->getColumnDimension('E')->setAutoSize(true);
            $sheetAppointmentStatusYear->getColumnDimension('F')->setAutoSize(true);

            // Populate data into the appointment status sheet

            $row = 2;

            foreach ($appointmentsAllStatusByYear as $appointment) {
                // Access object properties using object notation
                $sheetAppointmentStatusYear->setCellValue('A' . $row, $appointment->year);
                $sheetAppointmentStatusYear->setCellValue('B' . $row, $appointment->completed_appointments);
                $sheetAppointmentStatusYear->setCellValue('C' . $row, $appointment->pending_appointments);
                $sheetAppointmentStatusYear->setCellValue('D' . $row, $appointment->rejected_appointments);
                $sheetAppointmentStatusYear->setCellValue('E' . $row, $appointment->confirmed_appointments);
                $sheetAppointmentStatusYear->setCellValue('F' . $row, $appointment->total_appointments);
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

            $sheetSales->getColumnDimension('A')->setAutoSize(true);
            $sheetSales->getColumnDimension('B')->setAutoSize(true);

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

            $sheetSalesYear->getColumnDimension('A')->setAutoSize(true);
            $sheetSalesYear->getColumnDimension('B')->setAutoSize(true);

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

            $sheetPopularProducts->getColumnDimension('A')->setAutoSize(true);
            $sheetPopularProducts->getColumnDimension('B')->setAutoSize(true);
            $sheetPopularProducts->getColumnDimension('C')->setAutoSize(true);
            $sheetPopularProducts->getColumnDimension('D')->setAutoSize(true);
            $sheetPopularProducts->getColumnDimension('E')->setAutoSize(true);
            $sheetPopularProducts->getColumnDimension('F')->setAutoSize(true);
            $sheetPopularProducts->getColumnDimension('G')->setAutoSize(true);

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
            $sheetShopingStatus->setCellValue('A1', 'Month/Year');
            $sheetShopingStatus->setCellValue('B1', 'On-Proccess Count');
            $sheetShopingStatus->setCellValue('C1', 'Shipped Count');
            $sheetShopingStatus->setCellValue('D1', 'Total Orders');
            $sheetShopingStatus->setCellValue('E1', 'Additional Notes');

            $sheetShopingStatus->getColumnDimension('A')->setAutoSize(true);
            $sheetShopingStatus->getColumnDimension('B')->setAutoSize(true);
            $sheetShopingStatus->getColumnDimension('C')->setAutoSize(true);
            $sheetShopingStatus->getColumnDimension('D')->setAutoSize(true);
            $sheetShopingStatus->getColumnDimension('E')->setAutoSize(true);

            // Populate data into the sales sheet

            $row = 2;

            foreach ($shopingStatus as $status) {
                // Access object properties using object notation
                $sheetShopingStatus->setCellValue('A' . $row, $status->month_year);
                if($status->on_process_count > 0 && $status->month_year < date('Y-m')){
                    //cell color yellow
                    $sheetShopingStatus->getStyle('B' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
                    $sheetShopingStatus->setCellValue('B' . $row, $status->on_process_count);
                    //invoices id shows
                    $sheetShopingStatus->setCellValue('E' . $row, 'Invoices ID: ' . $status->invoice_id);

                }else{
                    $sheetShopingStatus->setCellValue('B' . $row, $status->on_process_count);
                }
                $sheetShopingStatus->setCellValue('C' . $row, $status->shipped_count);
                $sheetShopingStatus->setCellValue('D' . $row, $status->total_orders);        
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

        $sheetAnimalWardIncome->getColumnDimension('A')->setAutoSize(true);
        $sheetAnimalWardIncome->getColumnDimension('B')->setAutoSize(true);

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

        $sheetAnimalWardIncomeYear->getColumnDimension('A')->setAutoSize(true);
        $sheetAnimalWardIncomeYear->getColumnDimension('B')->setAutoSize(true);

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

        $sheetPetownerCount->getColumnDimension('A')->setAutoSize(true);
        $sheetPetownerCount->getColumnDimension('B')->setAutoSize(true);

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

        $sheetPetownerCountYear->getColumnDimension('A')->setAutoSize(true);
        $sheetPetownerCountYear->getColumnDimension('B')->setAutoSize(true);

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
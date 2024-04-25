<?php
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

        

        

}
<?php

class InvoiceController extends Controller
{
    private $invoiceModel;

    public function __construct()
    {
        $this->invoiceModel = new Invoice();
    }

    /**
     * -------------------------------------------------------
     * Invoice List
     * URL:
     * index.php?page=invoices
     * -------------------------------------------------------
     */
    public function index()
    {
        $invoices = $this->invoiceModel->getAll();

        $this->view(
            'invoices/index',
            [
                'invoices' => $invoices
            ]
        );
    }

    /**
     * -------------------------------------------------------
     * View Invoice
     * URL:
     * index.php?page=view-invoice&id=1
     * -------------------------------------------------------
     */
    public function show()
    {
        $orderId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$orderId) {

            return $this->redirectWithMessage(
                'invoices',
                'danger',
                'Invalid invoice selected.'
            );
        }

        $invoice = $this->invoiceModel->find($orderId);

        if (!$invoice) {

            return $this->redirectWithMessage(
                'invoices',
                'danger',
                'Invoice not found.'
            );
        }

        // Auto Generate Invoice Number
        if (empty($invoice['invoice_no'])) {

            $invoiceNo = $this->invoiceModel->generateInvoiceNumber();

            $this->invoiceModel->saveInvoiceNumber(
                $orderId,
                $invoiceNo
            );

            $invoice = $this->invoiceModel->find($orderId);
        }

        $measurements = $this->invoiceModel->getMeasurements($orderId);

        $options = $this->invoiceModel->getOptions($orderId);

        $this->view(
            'invoices/show',
            compact(
                'invoice',
                'measurements',
                'options',
                'paymentStatus'
            )
        );
    }

    /**
     * -------------------------------------------------------
     * Print Invoice
     * URL:
     * index.php?page=print-invoice&id=1
     * -------------------------------------------------------
     */
    public function print()
    {
        $orderId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$orderId) {

            exit('Invalid Invoice.');
        }

        $invoice = $this->invoiceModel->find($orderId);

        if (!$invoice) {

            exit('Invoice not found.');
        }

        if (empty($invoice['invoice_no'])) {

            $invoiceNo = $this->invoiceModel->generateInvoiceNumber();

            $this->invoiceModel->saveInvoiceNumber(
                $orderId,
                $invoiceNo
            );

            $invoice = $this->invoiceModel->find($orderId);
        }

        $measurements = $this->invoiceModel->getMeasurements($orderId);

        $options = $this->invoiceModel->getOptions($orderId);

    

        $this->view(
            'invoices/print',
            compact(
                'invoice',
                'measurements',
                'options',

            )
        );
    }
}
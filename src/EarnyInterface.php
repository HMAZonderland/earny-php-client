<?php
namespace Earny;
/**
 * Interface EarnyInterface
 *
 * Interface class to create mocks
 *
 * @package Earny
 */
interface EarnyInterface
{
    /**
     * Earny constructor.
     *
     * @param string $username
     * @param string $password
     * @param $certificatePath
     */
    public function __construct($username, $password, $certificatePath = '');

    /**
     * Returns contacts matching the given $filter
     *
     * @param array $filters
     *
     * @return array
     */
    public function getContacts($filters = []);

    /**
     * Returns all Contacts from Earny
     *
     * @param array $filters
     * @return array
     */
    public function getAllContacts($filters = []);

    /**
     * Gets a specific Contact
     *
     * @param $idcontact
     * @return array
     */
    public function getContact($idcontact);

    /**
     * Adds a new Contact
     *
     * @param $params
     * @return array
     */
    public function addContact($params);

    /**
     * Edits an existing Contact
     *
     * @param $idcontact
     * @param $params
     * @return array
     */
    public function editContact($idcontact, $params);

    /**
     * Returns all Invoices for the given Contact
     *
     * @param $idcontact
     * @return array
     */
    public function getInvoicesFromContact($idcontact);

    /**
     * Gets all Drafts for the given Contact
     *
     * @param $idcontact
     * @return array
     */
    public function getDraftsFromContact($idcontact);

    /**
     * Gets all Products matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getProducts($filters = []);

    /**
     * Returns a single Product
     *
     * @param $idproduct
     * @return array
     */
    public function getProduct($idproduct);

    /**
     * Adds a new Product
     *
     * @param $params
     * @return array
     */
    public function addProduct($params);

    /**
     * Edits an existing Product
     *
     * @param $idproduct
     * @param $params
     * @return array
     */
    public function editProduct($idproduct, $params);

    /**
     * Deletes a Product
     *
     * @param $idproduct
     * @return array
     */
    public function deleteProduct($idproduct);

    /**
     * Gets all categories matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getCategories($filters = []);

    /**
     * Returns a single Product
     *
     * @param $idcategory
     * @return array
     */
    public function getCategory($idcategory);

    /**
     * Adds a new Category
     *
     * @param $params
     * @return array
     */
    public function addCategory($params);

    /**
     * Edits an existing Category
     *
     * @param $idcategory
     * @param $params
     * @return array
     */
    public function editCategory($idcategory, $params);

    /**
     * Gets all Payment methods matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getPaymentMethods($filters = []);

    /**
     * Returns a single Payment Method
     *
     * @param $idpaymentmethod
     * @return array
     */
    public function getPaymentMethod($idpaymentmethod);

    /**
     * Adds a new PaymentMethod
     *
     * @param $params
     * @return array
     */
    public function addPaymentMethod($params);

    /**
     * Edits an existing Payment Method
     *
     * @param $idpaymentmethod
     * @param $params
     * @return array
     */
    public function editPaymentMethod($idpaymentmethod, $params);

    /**
     * Gets all VatGroups matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getVatGroups($filters = []);

    /**
     * Returns a single VatGroup
     *
     * @param $idvatgroup
     * @return array
     */
    public function getVatGroup($idvatgroup);

    /**
     * Gets all Drafts matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getDrafts($filters = []);

    /**
     * Gets a single Draft
     *
     * @param $iddraft
     * @return array
     */
    public function getDraft($iddraft);

    /**
     * Adds a new Draft
     *
     * @param $params
     * @return array
     */
    public function addDraft($params);

    /**
     * Edits an existing Draft
     *
     * @param $iddraft
     * @param $params
     * @return array
     */
    public function editDraft($iddraft, $params);

    /**
     * Adds a new DraftRule
     *
     * @param $idcontact
     * @param $rules
     * @return array
     */
    public function addDraftRule($idcontact, $rules);

    /**
     * Deletes a Draft
     *
     * @param $iddraft
     * @return array
     */
    public function deleteDraft($iddraft);

    /**
     * Creates an Invoice from a Draft
     *
     * @param $iddraft
     * @return array
     */
    public function createInvoiceFromDraft($iddraft);

    /**
     * Adds an attachment to a Draft
     *
     * @param $iddraft
     * @param $params
     * @return array
     */
    public function addAttachmentToDraft($iddraft, $params);

    /**
     * Deletes an attachment from a Draft
     *
     * @param $iddraft
     * @param $idattachment
     * @return array
     */
    public function deleteAttachmentFromDraft($iddraft, $idattachment);

    /**
     * Returns all Invoices matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getInvoices($filters = []);

    /**
     * Returns a single Invoice
     *
     * @param $idinvoice
     * @return array
     */
    public function getInvoice($idinvoice);

    /**
     * Sends an Invoice
     *
     * @param $idinvoice
     * @param $params
     * @return array
     */
    public function sendInvoice($idinvoice, $params);

    /**
     * Adds a Payment to an Invoice
     *
     * @param $idinvoice
     * @param $params
     * @return array
     */
    public function addPaymentToInvoice($idinvoice, $params);

    /**
     * Return $debug
     *
     * @return bool
     */
    public function isDebugMode();
}

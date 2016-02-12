<?php
namespace Earny;
/**
 * Class Earny
 *
 * Earny API Client
 *
 * @package Earny
 */
class Earny implements EarnyInterface
{
    /**
     * @var string $username - Login e-mail address
     */
    protected $username;

    /**
     * @var string $password - Account password
     */
    protected $password;

    /**
     * @var string $apihost - API hostname
     */
    protected $apihost = 'secure.earny.nl';

    /**
     * @var string $protocol - What protocol to use, we advice you to use https over http
     */
    protected $protocol = 'https';

    /**
     * @var string $apilocation - Api endpoint
     */
    protected $apilocation = '/api';

    /**
     * @var bool $debug - Debug mode
     */
    protected $debug = false;

    /**
     * @var string $clientversion - Client version
     */
    protected $clientversion = '1.0';

    /**
     * Earny constructor.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Returns contacts matching the given $filter
     *
     * @param array $filters
     *
     * @return array
     */
    public function getContacts($filters = array())
    {
        $result = $this->_sendRequest('/contacts', null, null, $filters);
        return $result;
    }

    /**
     * Returns all Contacts from Earny
     *
     * @param array $filters
     * @return array
     */
    public function getAllContacts($filters = array())
    {
        $allcontacts = false;
        $contacts = array();
        $i = 0;

        while ($allcontacts == false) {
            $filters['start'] = ($i * 100);
            $result = $this->getContacts($filters);

            if (count($result['data']) < 100) {
                $allcontacts = true;
            }

            foreach ($result['data'] as $contact) {
                $contacts[] = $contact;
            }

            $i++;
        }

        $result = array('success' => true, 'data' => $contacts);

        return $result;
    }

    /**
     * Gets a specific Contact
     *
     * @param $idcontact
     * @return array
     */
    public function getContact($idcontact)
    {
        $result = $this->_sendRequest('/contacts/' . $idcontact);
        return $result;
    }

    /**
     * Adds a new Contact
     *
     * @param $params
     * @return array
     */
    public function addContact($params)
    {
        $result = $this->_sendRequest('/contacts', $params, 'POST');
        return $result;
    }

    /**
     * Edits an existing Contact
     *
     * @param $idcontact
     * @param $params
     * @return array
     */
    public function editContact($idcontact, $params)
    {
        $result = $this->_sendRequest('/contacts/' . $idcontact, $params, 'PUT');
        return $result;
    }

    /**
     * Returns all Invoices for the given Contact
     *
     * @param $idcontact
     * @return array
     */
    public function getInvoicesFromContact($idcontact)
    {
        $result = $this->_sendRequest('/contacts/' . $idcontact . '/invoices');
        return $result;
    }

    /**
     * Gets all Drafts for the given Contact
     *
     * @param $idcontact
     * @return array
     */
    public function getDraftsFromContact($idcontact)
    {
        $result = $this->_sendRequest('/contacts/' . $idcontact . '/drafts');
        return $result;
    }


    /**
     * Gets all Products matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getProducts($filters = array())
    {
        $result = $this->_sendRequest('/products', null, null, $filters);
        return $result;
    }

    /**
     * Returns a single Product
     *
     * @param $idproduct
     * @return array
     */
    public function getProduct($idproduct)
    {
        $result = $this->_sendRequest('/products/' . $idproduct);
        return $result;
    }

    /**
     * Adds a new Product
     *
     * @param $params
     * @return array
     */
    public function addProduct($params)
    {
        $result = $this->_sendRequest('/products', $params, 'POST');
        return $result;
    }

    /**
     * Edits an existing Product
     *
     * @param $idproduct
     * @param $params
     * @return array
     */
    public function editProduct($idproduct, $params)
    {
        $result = $this->_sendRequest('/products/' . $idproduct, $params, 'PUT');
        return $result;
    }

    /**
     * Deletes a Product
     *
     * @param $idproduct
     * @return array
     */
    public function deleteProduct($idproduct)
    {
        $result = $this->_sendRequest('/products/' . $idproduct, null, 'DELETE');
        return $result;
    }


    /**
     * Gets all categories matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getCategories($filters = array())
    {
        $result = $this->_sendRequest('/categories', null, null, $filters);
        return $result;
    }

    /**
     * Returns a single Product
     *
     * @param $idcategory
     * @return array
     */
    public function getCategory($idcategory)
    {
        $result = $this->_sendRequest('/categories/' . $idcategory);
        return $result;
    }

    /**
     * Adds a new Category
     *
     * @param $params
     * @return array
     */
    public function addCategory($params)
    {
        $result = $this->_sendRequest('/categories', $params, 'POST');
        return $result;
    }

    /**
     * Edits an existing Category
     *
     * @param $idcategory
     * @param $params
     * @return array
     */
    public function editCategory($idcategory, $params)
    {
        $result = $this->_sendRequest('/categories/' . $idcategory, $params, 'PUT');
        return $result;
    }


    /**
     * Gets all Payment methods matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getPaymentMethods($filters = array())
    {
        $result = $this->_sendRequest('/paymentmethods', null, null, $filters);
        return $result;
    }

    /**
     * Returns a single Payment Method
     *
     * @param $idpaymentmethod
     * @return array
     */
    public function getPaymentMethod($idpaymentmethod)
    {
        $result = $this->_sendRequest('/paymentmethods/' . $idpaymentmethod);
        return $result;
    }

    /**
     * Adds a new PaymentMethod
     *
     * @param $params
     * @return array
     */
    public function addPaymentMethod($params)
    {
        $result = $this->_sendRequest('/paymentmethods', $params, 'POST');
        return $result;
    }

    /**
     * Edits an existing Payment Method
     *
     * @param $idpaymentmethod
     * @param $params
     * @return array
     */
    public function editPaymentMethod($idpaymentmethod, $params)
    {
        $result = $this->_sendRequest('/paymentmethods/' . $idpaymentmethod, $params, 'PUT');
        return $result;
    }


    /**
     * Gets all VatGroups matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getVatGroups($filters = array())
    {
        $result = $this->_sendRequest('/vatgroups', null, null, $filters);
        return $result;
    }

    /**
     * Returns a single VatGroup
     *
     * @param $idvatgroup
     * @return array
     */
    public function getVatGroup($idvatgroup)
    {
        $result = $this->_sendRequest('/vatgroups/' . $idvatgroup);
        return $result;
    }


    /**
     * Gets all Drafts matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getDrafts($filters = array())
    {
        $result = $this->_sendRequest('/drafts', null, null, $filters);
        return $result;
    }

    /**
     * Gets a single Draft
     *
     * @param $iddraft
     * @return array
     */
    public function getDraft($iddraft)
    {
        $result = $this->_sendRequest('/drafts/' . $iddraft);
        return $result;
    }

    /**
     * Adds a new Draft
     *
     * @param $params
     * @return array
     */
    public function addDraft($params)
    {
        $result = $this->_sendRequest('/drafts', $params, 'POST');
        return $result;
    }

    /**
     * Edits an existing Draft
     *
     * @param $iddraft
     * @param $params
     * @return array
     */
    public function editDraft($iddraft, $params)
    {
        $result = $this->_sendRequest('/drafts/' . $iddraft, $params, 'PUT');
        return $result;
    }

    /**
     * Adds a new DraftRule
     *
     * @param $idcontact
     * @param $rules
     * @return array
     */
    public function addDraftRule($idcontact, $rules)
    {
        $currentdrafts = $this->getDrafts(array('idcontact' => $idcontact));
        if ($currentdrafts['success'] == true) {
            if (count($currentdrafts['data']) > 0) {
                $iddraft = $currentdrafts['data'][0]['iddraft'];
                $result = $this->editDraft($iddraft, array('rules' => $rules));
            } else {
                $result = $this->addDraft(array('idcontact' => $idcontact, 'rules' => $rules));
            }
            return $result;
        } else {
            return $currentdrafts;
        }
    }

    /**
     * Deletes a Draft
     *
     * @param $iddraft
     * @return array
     */
    public function deleteDraft($iddraft)
    {
        $result = $this->_sendRequest('/drafts/' . $iddraft, null, 'DELETE');
        return $result;
    }

    /**
     * Creates an Invoice from a Draft
     *
     * @param $iddraft
     * @return array
     */
    public function createInvoiceFromDraft($iddraft)
    {
        $result = $this->_sendRequest('/drafts/' . $iddraft . '/createinvoice', null, 'POST');
        return $result;
    }

    /**
     * Adds an attachment to a Draft
     *
     * @param $iddraft
     * @param $params
     * @return array
     */
    public function addAttachmentToDraft($iddraft, $params)
    {
        $result = $this->_sendRequest('/drafts/' . $iddraft . '/attachments', $params, 'POST');
        return $result;
    }

    /**
     * Deletes an attachment from a Draft
     *
     * @param $iddraft
     * @param $idattachment
     * @return array
     */
    public function deleteAttachmentFromDraft($iddraft, $idattachment)
    {
        $result = $this->_sendRequest('/drafts/' . $iddraft . '/attachments/' . $idattachment, null, 'DELETE');
        return $result;
    }


    /**
     * Returns all Invoices matching the given filter
     *
     * @param array $filters
     * @return array
     */
    public function getInvoices($filters = array())
    {
        $result = $this->_sendRequest('/invoices', null, null, $filters);
        return $result;
    }

    /**
     * Returns a single Invoice
     *
     * @param $idinvoice
     * @return array
     */
    public function getInvoice($idinvoice)
    {
        $result = $this->_sendRequest('/invoices/' . $idinvoice);
        return $result;
    }

    /**
     * Sends an Invoice
     *
     * @param $idinvoice
     * @param $params
     * @return array
     */
    public function sendInvoice($idinvoice, $params)
    {
        $result = $this->_sendRequest('/invoices/' . $idinvoice . '/send', $params, 'POST');
        return $result;
    }

    /**
     * Adds a Payment to an Invoice
     *
     * @param $idinvoice
     * @param $params
     * @return array
     */
    public function addPaymentToInvoice($idinvoice, $params)
    {
        $result = $this->_sendRequest('/invoices/' . $idinvoice . '/payments', $params, 'POST');
        return $result;
    }

    /**
     * Enable debug mode
     */
    public function enableDebugmode()
    {
        $this->debug = true;
    }

    /**
     * Sends out the request
     *
     * @param $endpoint
     * @param array $params
     * @param string $method
     * @param array $filters
     * @return array
     */
    protected function _sendRequest($endpoint, $params = array(), $method = 'GET', $filters = array())
    {
        $ch = curl_init();

        if (!empty($filters)) {
            $i = 0;
            foreach ($filters as $key => $value) {
                if ($i == 0) {
                    $endpoint .= '?';
                } else {
                    $endpoint .= '&';
                }
                $endpoint .= $key . '=' . urlencode($value);
                $i++;
            }
        }

        if ($this->debug) {
            echo 'URL: ' . $this->_getUrl($endpoint) . "\n";
        }

        curl_setopt($ch, CURLOPT_URL, $this->_getUrl($endpoint));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Earny PHP API Client ' . $this->clientversion . ' (www.earny.nl)');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));

        if ($method == 'POST' || $method == 'PUT' || $method == 'DELETE') {
            $data = $this->_prepareData($params);
            if ($this->debug) {
                echo 'Data: ' . $data . "\n";
            }
            if ($method == 'POST') {
                curl_setopt($ch, CURLOPT_POST, true);
            } elseif ($method == 'PUT') {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            } elseif ($method == 'DELETE') {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $apiresult = curl_exec($ch);
        $headerinfo = curl_getinfo($ch);

        if ($this->debug) {
            echo 'Raw result: ' . $apiresult . "\n";
        }

        curl_close($ch);
        $apiresult_json = json_decode($apiresult, true);

        $result = array();

        if (!in_array($headerinfo['http_code'], array('200', '201', '204'))) {
            $result['success'] = false;
            $result['errorcode'] = $headerinfo['http_code'];
            if (isset($apiresult)) {
                $result['errormessage'] = $apiresult;
            }
        } else {
            $result['success'] = true;
            $result['data'] = (($apiresult_json === null) ? $apiresult : $apiresult_json);
        }

        return $result;
    }

    /**
     * Returns the full API url
     *
     * @param $endpoint
     * @return string
     */
    protected function _getUrl($endpoint)
    {
        return $this->protocol . '://' . $this->apihost . $this->apilocation . $endpoint;
    }

    /**
     * Prepares the data for the request
     *
     * @param $params
     * @return string
     */
    protected function _prepareData($params)
    {
        $data = json_encode($params);
        return $data;
    }
}
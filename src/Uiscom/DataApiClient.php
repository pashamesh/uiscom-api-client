<?php

declare(strict_types=1);

namespace Uiscom;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use InvalidArgumentException;

/**
 * @method object loginUser(array<string,mixed> $params = [])
 * @method object logoutUser(array<string,mixed> $params = [])
 *
 * @method array<int, object>getVirtualNumbers(array<string,mixed> $params = [])
 * @method array<int, object>getAvailableVirtualNumbers(array<string,mixed> $params = [])
 * @method object enableVirtualNumbers(array<string,mixed> $params = [])
 * @method object disableVirtualNumbers(array<string,mixed> $params = [])
 * @method array<int, object>getobjCallProcessingRules(array<string,mixed> $params = [])
 * @method object setCallProcessingRuleIsActive(array<string,mixed> $params = [])
 *
 * @method object createSipLines(array<string,mixed> $params = [])
 * @method object deleteSipLines(array<string,mixed> $params = [])
 * @method array<int, object>getSipLineVirtualNumbers(array<string,mixed> $params = [])
 * @method array<int, object>getSipLines(array<string,mixed> $params = [])
 * @method object updateSipLines(array<string,mixed> $params = [])
 * @method object updateSipLinePassword(array<string,mixed> $params = [])
 *
 * @method object createCampaigns(array<string,mixed> $params = [])
 * @method object deleteCampaigns(array<string,mixed> $params = [])
 * @method array<int, object>getCampaigns(array<string,mixed> $params = [])
 * @method object updateCampaigns(array<string,mixed> $params = [])
 * @method array<int, object>getCampaignAvailablePhoneNumbers(array<string,mixed> $params = [])
 * @method array<int, object>getCampaignAvailableRedirectionPhoneNumbers(array<string,mixed> $params = [])
 * @method array<int, object>getCampaignParameterWeights(array<string,mixed> $params = [])
 * @method object updateCampaignParameterWeights(array<string,mixed> $params = [])
 * @method object uploadCampaignCosts(array<string,mixed> $params = [])
 *
 * @method array<int, object>getSources(array<string,mixed> $params = [])
 * @method array<int, object>getSourceCosts(array<string,mixed> $params = [])
 * @method object uploadSourceCosts(array<string,mixed> $params = [])
 * @method object createSource(array<string,mixed> $params = [])
 * @method array<int, object>getSourceFilters(array<string,mixed> $params = [])
 * @method array<int, object>getSourcesGroups(array<string,mixed> $params = [])
 *
 * @method array<int, object>getAutoCallCampaigns(array<string,mixed> $params = [])
 * @method object deleteAutoCallCampaignPhoneNumbers(array<string,mixed> $params = [])
 *
 * @method object createSalesFunnel(array<string,mixed> $params = [])
 * @method object deleteSalesFunnel(array<string,mixed> $params = [])
 * @method object getSalesFunnel(array<string,mixed> $params = [])
 * @method object updateSalesFunnel(array<string,mixed> $params = [])
 * @method object createSalesFunnelStages(array<string,mixed> $params = [])
 * @method object deleteSalesFunnelStages(array<string,mixed> $params = [])
 * @method object updateSalesFunnelStages(array<string,mixed> $params = [])
 * @method object createDealContacts(array<string,mixed> $params = [])
 * @method object deleteDealContacts(array<string,mixed> $params = [])
 * @method array<int, object>getDealContacts(array<string,mixed> $params = [])
 * @method object updateDealContacts(array<string,mixed> $params = [])
 * @method object createDealEmployees(array<string,mixed> $params = [])
 * @method object deleteDealEmployees(array<string,mixed> $params = [])
 * @method array<int, object>getDealEmployees(array<string,mixed> $params = [])
 * @method object updateDealEmployees(array<string,mixed> $params = [])
 * @method object uploadDealsHistory(array<string,mixed> $params = [])
 * @method object getDealsProcessing(array<string,mixed> $params = [])
 * @method object deleteDeals(array<string,mixed> $params = [])
 * @method array<int, object>getDealsHistory(array<string,mixed> $params = [])
 * @method object createDealUserField(array<string,mixed> $params = [])
 * @method object updateDealUserField(array<string,mixed> $params = [])
 * @method array<int, object>getDealUserFields(array<string,mixed> $params = [])
 * @method object deleteDealUserField(array<string,mixed> $params = [])
 *
 * @method object createSites(array<string,mixed> $params = [])
 * @method object deleteSites(array<string,mixed> $params = [])
 * @method array<int, object>getSites(array<string,mixed> $params = [])
 * @method object updateSites(array<string,mixed> $params = [])
 * @method object createSiteBlocks(array<string,mixed> $params = [])
 * @method object deleteSiteBlocks(array<string,mixed> $params = [])
 * @method array<int, object>getSiteBlocks(array<string,mixed> $params = [])
 * @method object updateSiteBlocks(array<string,mixed> $params = [])
 *
 * @method array<int, object>getCommunicationsReport(array<string,mixed> $params = [])
 * @method array<int, object>getCampaignDailyStat(array<string,mixed> $params = [])
 * @method array<int, object>getEmployeeStat(array<string,mixed> $params = [])
 * @method array<int, object>getCommunications(array<string,mixed> $params = [])
 * @method array<int, object>getobjReportTable(array<string,mixed> $params = [])
 * @method array<int, object>getobjReportTotal(array<string,mixed> $params = [])
 * @method array<int, object>getVisits(array<string,mixed> $params = [])
 * @method array<int, object>getCallsReport(array<string,mixed> $params = [])
 * @method array<int, object>getCallLegsReport(array<string,mixed> $params = [])
 * @method array<int, object>getFinancialCallLegsReport(array<string,mixed> $params = [])
 * @method array<int, object>getChatsReport(array<string,mixed> $params = [])
 * @method array<int, object>getChatMessagesReport(array<string,mixed> $params = [])
 * @method array<int, object>getChatChannelsReport(array<string,mixed> $params = [])
 * @method array<int, object>getOfflineMessagesReport(array<string,mixed> $params = [])
 * @method array<int, object>getGoalsReport(array<string,mixed> $params = [])
 * @method array<int, object>getVisitorSessionsReport(array<string,mixed> $params = [])
 * @method array<int, object>getCtAcSummaryReport(array<string,mixed> $params = [])
 * @method array<int, object>getCtSummaryReport(array<string,mixed> $params = [])
 * @method array<int, object>getobjColumnsTree(array<string,mixed> $params = [])
 * @method array<int, object>getReportsList(array<string,mixed> $params = [])
 * @method array<int, object>getReportFilters(array<string,mixed> $params = [])
 * @method array<int, object>getobjDimensionsTree(array<string,mixed> $params = [])
 * @method array<int, object>getReportTypes(array<string,mixed> $params = [])
 *
 * @method object createTags(array<string,mixed> $params = [])
 * @method object deleteTags(array<string,mixed> $params = [])
 * @method array<int, object>getTags(array<string,mixed> $params = [])
 * @method object updateTags(array<string,mixed> $params = [])
 * @method object setTagSales(array<string,mixed> $params = [])
 * @method object setTagCommunications(array<string,mixed> $params = [])
 * @method object unsetTagCommunications(array<string,mixed> $params = [])
 *
 * @method object createEmployees(array<string,mixed> $params = [])
 * @method object deleteEmployees(array<string,mixed> $params = [])
 * @method array<int, object>getEmployees(array<string,mixed> $params = [])
 * @method object updateEmployees(array<string,mixed> $params = [])
 * @method object createGroupEmployees(array<string,mixed> $params = [])
 * @method object deleteGroupEmployees(array<string,mixed> $params = [])
 * @method array<int, object>getGroupEmployees(array<string,mixed> $params = [])
 * @method object updateGroupEmployees(array<string,mixed> $params = [])
 * @method object updateGroupEmployeesNumbers(array<string,mixed> $params = [])
 * @method object createEmployeePositions(array<string,mixed> $params = [])
 * @method object deleteEmployeePositions(array<string,mixed> $params = [])
 * @method array<int, object>getEmployeePositions(array<string,mixed> $params = [])
 * @method object updateEmployeePositions(array<string,mixed> $params = [])
 * @method array<int, object>getStatuses(array<string,mixed> $params = [])
 *
 * @method object createContacts(array<string,mixed> $params = [])
 * @method object deleteContacts(array<string,mixed> $params = [])
 * @method array<int, object>getContacts(array<string,mixed> $params = [])
 * @method object updateContacts(array<string,mixed> $params = [])
 * @method object createGroupContacts(array<string,mixed> $params = [])
 * @method object deleteGroupContacts(array<string,mixed> $params = [])
 * @method array<int, object>getGroupContacts(array<string,mixed> $params = [])
 * @method object updateGroupContacts(array<string,mixed> $params = [])
 * @method object createContactOrganizations(array<string,mixed> $params = [])
 * @method object deleteContactOrganizations(array<string,mixed> $params = [])
 * @method array<int, object>getContactOrganizations(array<string,mixed> $params = [])
 * @method object updateContactOrganizations(array<string,mixed> $params = [])
 *
 * @method object createPhoneNumberToBlacklist(array<string,mixed> $params = [])
 * @method object deletePhoneNumberFromBlacklist(array<string,mixed> $params = [])
 * @method array<int, object>getBlacklistPhoneNumbers(array<string,mixed> $params = [])
 *
 * @method object createSchedules(array<string,mixed> $params = [])
 * @method object deleteSchedules(array<string,mixed> $params = [])
 * @method array<int, object>getSchedules(array<string,mixed> $params = [])
 * @method object updateSchedules(array<string,mixed> $params = [])
 *
 * @method object createCustomers(array<string,mixed> $params = [])
 * @method array<int, object>getCustomers(array<string,mixed> $params = [])
 * @method object updateCustomers(array<string,mixed> $params = [])
 * @method object updateCustomerStatus(array<string,mixed> $params = [])
 * @method array<int, object>getTariffPlans(array<string,mixed> $params = [])
 * @method object updateCustomerTariffPlans(array<string,mixed> $params = [])
 * @method array<int, object>getCustomerUsers(array<string,mixed> $params = [])
 *
 * @method object uploadCalls(array<string,mixed> $params = [])
 * @method array<int, object>getUploadedCalls(array<string,mixed> $params = [])
 * @method object uploadOfflineMessages(array<string,mixed> $params = [])
 * @method object deleteOfflineMessages(array<string,mixed> $params = [])
 * @method object createOfflineMessageUserField(array<string,mixed> $params = [])
 * @method object deleteOfflineMessageUserField(array<string,mixed> $params = [])
 * @method object updateOfflineMessageUserField(array<string,mixed> $params = [])
 * @method array<int, object>getOfflineMessageUserFields(array<string,mixed> $params = [])
 * @method object uploadChats(array<string,mixed> $params = [])
 * @method object deleteChats(array<string,mixed> $params = [])
 * @method object uploadEmails(array<string,mixed> $params = [])
 * @method object createCommunicationComment(array<string,mixed> $params = [])
 *
 * @method object getobjPersonForVisitor(array<string,mixed> $params = [])
 * @method array<int, object>getPersonVisitors(array<string,mixed> $params = [])
 * @method object getobjVisitor(array<string,mixed> $params = [])
 */
class DataApiClient
{
    private string $version = 'v2.0';
    private DataApiConfig $config;
    private Client $client;

    private ?object $metadata = null;

    public function __construct(DataApiConfig $config, ?Client $client = null)
    {
        $this->client = $client ?? new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json; charset=UTF-8',
            ],
        ]);
        $this->config = $config;
    }

    private function getBaseUri(): string
    {
        return rtrim($this->config->getEntryPoint(), '/') .
            '/' . $this->version;
    }

    /**
     * Get last response metadata
     *
     */
    public function metadata(): ?object
    {
        return $this->metadata;
    }

    /**
     * @param array<int,array<string,mixed>> $arguments
     *
     * @return array<int,object>|object
     *
     */
    public function __call(string $camelCaseMethod, array $arguments)
    {
        $camelCaseMethod = preg_replace(
            '~(.)(?=[A-Z])~',
            '$1_',
            $camelCaseMethod
        );

        if (! is_string($camelCaseMethod)) {
            throw new InvalidArgumentException('$camelCaseMethod must be a string');
        }

        $method = strtolower((string) preg_replace('~_~', '.', $camelCaseMethod, 1));

        $params = ['access_token' => $this->config->getAccessToken()];
        if (isset($arguments[0])) {
            $params = array_merge($params, $arguments[0]);
        }

        return $this->doRequest($method, $params);
    }

    /**
     * @param array<string,mixed> $params
     *
     * @return array<int,object>|object
     *
     * @throws Exception
     *
     */
    private function doRequest(string $method, array $params)
    {
        $payload = [
            'jsonrpc' => '2.0',
            'id' => time(),
            'method' => $method,
            'params' => $params,
        ];

        try {
            $response = $this->client->post($this->getBaseUri(), ['json' => $payload]);

            /**
             * @var object{
             *     result: object{
             *         data: array<int,object>|object,
             *         metadata: object,
             *     },
             *     error: object{
             *         code: int,
             *         message: string,
             *     }
             * } $responseBody
             */
            $responseBody = json_decode($response->getBody()->getContents());

            if (isset($responseBody->result)) {
                $this->metadata = $responseBody->result->metadata;
            }

            if (isset($responseBody->error)) {
                throw new Exception(
                    $responseBody->error->message,
                    $responseBody->error->code
                );
            }

            return $responseBody->result->data;
        } catch (TransferException $transferException) {
            throw new Exception(
                $transferException->getMessage(),
                $transferException->getCode(),
                $transferException
            );
        }
    }
}

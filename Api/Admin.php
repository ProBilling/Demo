<?php
/**
 * Demo boxbilling management 
 */

namespace Box\Mod\Demo;

class Admin extends \Api_Abstract
{
    /**
     * Reset all data for demo page
     * 
     * @return bool
     */
    public function reset()
    {
        $extensionService = $this->di['mod_service']('extension');
        $extensionService->activateExistingExtension(array('id'=>'redirect', 'type'=>'mod'));
        $extensionService->activateExistingExtension(array('id'=>'massmailer', 'type'=>'mod'));
        $extensionService->activateExistingExtension(array('id'=>'serviceyouhosting', 'type'=>'mod'));
        $extensionService->activateExistingExtension(array('id'=>'servicecentovacast', 'type'=>'mod'));
        $extensionService->activateExistingExtension(array('id'=>'servicesolusvm', 'type'=>'mod'));
        $extensionService->activateExistingExtension(array('id'=>'serviceboxbillinglicense', 'type'=>'mod'));

        $emailService = $this->di['mod_service']('email');
        $emailService->templateBatchGenerate();
        
        $client_1 = array(
            'email'=> "client@boxbilling.com",
            'password'=> "demo",
            'first_name'=> "Demo",
            'last_name'=> "Client",
            'phone_cc'=> "214",
            'phone'=> "15551212",
            'birthday'=> "1985-02-25",
            'company'=> "BoxBilling",
            'address_1'=> "Holywood",
            'address_2'=> "Stairway to heaven",
            'city'=> "Holywood",
            'state'=> "LA",
            'postcode'=> "95012",
            'country'=> "US",
            'currency'=> "USD",
            'notes'=> "BoxBilling demo client",
            'api_token'=> "client_api_token",
            'created_at'=> date('c'),
            'updated_at'=> date('c'),
        );
    
        $client_2 = array(
            'email'=> "john.smith@boxbilling.com",
            'password'=> "demo",
            'first_name'=> "John",
            'last_name'=> "Smith",
            'company'=> "John's Company Inc.",
            'phone_cc'=> "261",
            'phone'=> "4106851180",
            'birthday'=> "1985-02-25",
            'address_1'=> "1734 Maryland Avenue",
            'address_2'=> "Stairway to heaven",
            'city'=> "Baltimore",
            'state'=> "MD",
            'postcode'=> "21201",
            'country'=> "US",
            'currency'=> "USD",
            'notes'=> "BoxBilling demo client",
            'created_at'=> date('c'),
            'updated_at'=> date('c'),
        );

        $clientService = $this->di['mod_service']('client');

        $clientService->adminCreateClient($client_1);
        $clientService->adminCreateClient($client_2);

        $cronService = $this->di['mod_service']('cron');
        $cronService->runCrons();

        $this->di['logger']->info('Demo reset initiated');
        return true;
    }
}
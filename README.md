# query-orm

```bash
php test.php

''' result
ITOP (OQL) =>
string(245) "SELECT FM, CI FROM FacilitiesMonitoring AS FM JOIN FunctionalCI AS CI ON Q.functionalci_id = CI.id WHERE CI.obsolescence_flag = '0' AND (Q.status = 'active' OR FacilitiesMonitoring.id NOT IN (SELECT FacilitiesMonitoring AS FM WHERE Q.id = '23'))"

SALESFORCE (SOQL) =>
string(891) "SELECT Id, IsDeleted, MasterRecordId, Name, Type, ParentId, BillingStreet, BillingCity, BillingState, BillingPostalCode, BillingCountry, BillingLatitude, BillingLongitude, BillingGeocodeAccuracy, BillingAddress, ShippingStreet, ShippingCity, ShippingState, ShippingPostalCode, ShippingCountry, ShippingLatitude, ShippingLongitude, ShippingGeocodeAccuracy, ShippingAddress, Phone, Fax, AccountNumber, Website, PhotoUrl, Sic, Industry, AnnualRevenue, NumberOfEmployees, Ownership, TickerSymbol, Description, Rating, Site, CurrencyIsoCode, OwnerId, CreatedDate, CreatedById, LastModifiedDate, LastModifiedById, SystemModstamp, LastActivityDate, LastViewedDate, LastReferencedDate, IsPartner, ChannelProgramName, ChannelProgramLevelName, Jigsaw, JigsawCompanyId, AccountSource, SicDesc, Customer_Number_Text__c FROM Account AS A WHERE Id = '23' AND (Name = 'test' OR Email NOT LIKE '%@gmail.fr')"
'''
```

# Vereafy PHP Library

- [Vereafy PHP Library](#vereafy-php-library)
  - [Introduction](#introduction)
  - [How to Get API Key](#how-to-get-api-key)
  - [Initialization](#initialization)
  - [Completion](#completion)
  - [Resend](#resend)
  - [Get Balance](#get-balance)
  - [Error Responses](#error-responses)

----------

## Introduction

Vereafy is an SMS based 2-factor authentication services that uses machine learning to understand the causes of OTP delivery failures and resolves them instantly to ensure your login and sign up OTPs deliver.

The Vereafy PHP Library Project was created to enable PHP Developers integrate seamlessly with the Vereafy API.

To use the Vereafy PHP library, you just need to clone this repo into your existing project directory and require the Vereafy class file (Vereafy.php)

## How to Get API Key

Your API Key is first generated when you register an app. To register an app,
Login to the Developers Dashboard, Navigate to Apps > Add, Type the name of your app and click **Submit**. The app will be registered and a new API Key will be generated. Copy the API key into your project.

OR

Click [developer.cecula.com](https://developer.cecula.com/docs/introduction/generating-api-key) to get started.


## Initialization

 The Vereafy 2FA initialization can be as simple as the following lines of code:

         $vereafyInstance = new Vereafy(<your_APIKEY>);
         $vereafyInstance->init(<your_MOBILE>);

The initialization method returns a response that should look like this:

             {
                "status":"success",
                 "pinRef": "1293488527"
             }

## Completion

 The Vereafy 2FA completion can be as simple as the following lines of code:

         $vereafyInstance = new Vereafy(<your_APIKEY>);
         $vereafyInstance->complete(<pinRef>, <VERIFICATION_CODE>);

The completion method returns a response that should look like this if the parameters are correct:

             {
                "response":"success"
             }

## Resend

In a case where your app users get impatient and hits the retry link on your app form, just call the resend method this way:
 
         $vereafyInstance = new Vereafy(<your_APIKEY>);
         $vereafyInstance->resend(<your_MOBILE>, <pinRef>);

The resend method returns a response that should look like this:

             {
                 "status": "success",
                 "pinRef": 1293488527
             }

## Get Balance

To get your balance on Vereafy, the getbalance method is used this way:
            
            $vereafyInstance = new Vereafy(<your_APIKEY>);
            $vereafyInstance->getBalance();
The method requires no parameter, and the returned response should look like this:

            {
                 "balance":1507
            }

## Error Responses

In a case where the request fails due to one reason or another you should get an error response from the requested endpoint that looks like this:

            {
                "error":"Invalid PIN Ref",
                "code":"CE2000"
            }
            
The table below shows a list of error codes and their descriptions

|  Error Code                   |   Description        |    
|-------------------------------|----------------------|
| CE1001  | Missing Fields            |
| CE1002  | Empty Fields               | 
| CE1006  | Not a Nigerian Number               | 
| CE2000  | Invalid PIN Ref| 
| CE2002  | PIN does not reference any verification request| 
| CE2003  | Mobile number does not match original request| 
| CE2001  | Invalid PIN| 
| CE2004  | Request Not Found               | 
| CE7000  | Verification already succeeded     | 
| CE7001  | Verification already failed      | 
| CE6000  | Insufficient Balance     | 
| CE5000  | Invalid Template ID             | 
| CE5001  | Could not find referenced template                | 

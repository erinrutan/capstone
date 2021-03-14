const config = {
    s3: {
      REGION: "YOUR_S3_UPLOADS_BUCKET_REGION",
      BUCKET: "YOUR_S3_UPLOADS_BUCKET_NAME",
    },
    apiGateway: {
      REGION: "YOUR_API_GATEWAY_REGION",
      URL: "YOUR_API_GATEWAY_URL",
    },
    cognito: {
      REGION: "us-east-2_3gJLnFDtO", // east-2:977705494435:userpool/us-east-2_3gJLnFDtO
      USER_POOL_ID: "us-east-2_3gJLnFDtO",
      APP_CLIENT_ID: "c49lcp6qnbhuvuppntjn8sqdfsj",
      IDENTITY_POOL_ID: "YOUR_IDENTITY_POOL_ID",
    },
  };
  
  export default config;
  
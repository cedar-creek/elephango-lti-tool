CREATE TABLE lti_key_set (
  id UUID NOT NULL,

  CONSTRAINT pk_lti_key_set_id PRIMARY KEY (id)
);

CREATE TABLE lti_key
(
    id          UUID NOT NULL,
    key_set_id  UUID NOT NULL REFERENCES lti_key_set(id),
    private_key TEXT NOT NULL,
    alg         TEXT NOT NULL,

    CONSTRAINT pk_lti_key_id PRIMARY KEY (id)
);

CREATE TABLE lti_registration (
    id                             UUID NOT NULL,
    issuer                         TEXT NOT NULL,
    client_id                      TEXT NOT NULL,
    platform_login_auth_endpoint   TEXT NOT NULL,
    platform_service_auth_endpoint TEXT NOT NULL,
    platform_jwks_endpoint         TEXT NOT NULL,
    platform_auth_provider         TEXT,
    key_set_id                     UUID NOT NULL REFERENCES lti_key_set(id),

    CONSTRAINT pk_lti_registration_id PRIMARY KEY (id),
    UNIQUE (issuer, client_id)
);

CREATE TABLE lti_deployment (
  deployment_id TEXT NOT NULL,
  registration_id UUID NOT NULL REFERENCES lti_registration(id),
  customer_id TEXT NOT NULL,

  CONSTRAINT pk_deployment_id PRIMARY KEY (registration_id, deployment_id)
);

/* Insert dummy data */

INSERT INTO lti_key_set VALUES('d48a53de-021f-46f7-a0a4-7134812c2235');

INSERT INTO lti_key VALUES(
    '1e3f0512-2066-4f8a-8916-2d278bf49524',
    'd48a53de-021f-46f7-a0a4-7134812c2235',
    '-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAzAP2bjLZestZVVlSTps7zf/QoOS28Y8vY2PCE/XgVdKqAOA7
qulUTQyozAgd6X75I1JoHG0f5mxZAhu9r+qFSPU1FsmC+HFNmk7jV8/AsmDxSd9t
MsYHK49ToIEPy/REIh93Yjg5c7eYKCFbMzWLtmV/VuaegaV3wD4rhj6Oamyfbk9j
74fv34HjeNYTx9b1VdRwX50Lwje/FqqMV90WdBp4bZC0+vcDEM+hSdvev3c2+3bZ
VJFklzewkGkXi+xRo1TR9mJGwMs8GBhF3ELmyyVUGDCh57dam3RCZ6WdMvKhGbf9
1dt5VvHJqlFtYN1IyTymTPKd2tZe6G0eGOjcywIDAQABAoIBACXqhp4sbSbZLB0k
oJtjVlYOuSNt3mI+jjwWijdTdwH8SQQoqG43NyeqtqRUzdpbcsoRwq+lyEv2zwQJ
S9Op7mOEzv0RLnol9Jo9Fxt2zQVZ5v4nvA+3phV+abhmxBzPpOoClxl2AZd0A59R
s7Vsui6H5oasDcFik0LzSvuEHMvCVxJ3pTyq/b5PVI5SUpJL+3EcoPhfvj2QAT4/
1pWGF7jVGlALyJPtkPAJB/RZs1LN4FqeKoS5V3YKLswmDnxm/iHZVlOXLBnfL13h
QjPT+YcJDcIHiEo7yOaPtqmAlhaUSysOxRREUL/PxDUWIrQRRr+lawLoXLYFHwKz
7FGo9AECgYEA+DNvCwlfq5xK9agCcxxca0kTkDlLlU0WVLGKXIvxoxvJbX5YTxrs
ZCQ2eEnOtiKQqQ+uqjQ8msl0KHz46UHMjhfdSA8rgnerexe7TASkO3B8laIicSwc
FWRlq4YgevA5IcARZUN8cl8bgJHNEVXnVfGQ2UM8F/Gh8d5TRZt9YUsCgYEA0m0Y
LW1XNl0Ajt0KbIgy34c+xaVWHaZZhFNypOFtkXcnXGBWZgyjh6/FzYAkiZ8lNLXB
LqUrFaZiKIVWkUZk0WYmZ8AWvd/L6GivB1rlF+mHGTHC+yRGYCcniHqhpJcVRINk
2T5ajM73k+bzAMcy7QWntai07wkHmAELJ1EAwoECgYEA9q+gMVb6uIUZ17lJ3gEV
NiimghUAM38vr7PZ8gvBeb0XYXVO7iizRQDdBodNJaeLIg0NK+vJRIrvoYI8nxGf
7qZ3b7RsKTspu6klpfODC/TMTqicFOGjc/uaNXWU+Luj/RB5+ayulrpCinHfYNiB
meEDd30k0COAMvYmy6s0XasCgYAfqWSa6TnXJzU/SckYvYGSGqJ6UL9dZLtRatD0
OCspWRlmD+TQJBSzBOKpYh+dSYHqpXJ010tdTZS1biKxZzsiOtGKiN+jIDppNN8p
JycTawL16oPhD/s62olbQsBxqH39uhuBiJ1NVJLyAS0NL+vcuB4c+k6HLP+kgnuw
JcMMgQKBgAYjTCCAfLFyCPeudNTn6yuM6w361qOHGCEf/tVO/uavOldYQSCfjvZi
rOln4uBfOAU2tvK/dXNqFb0QufoCGCHYERuypUXRR2Upm+aATWuxCntte1e5eqHc
crSqxYouP8p8F25058LIy2qZgzHiJWAPaNBezUcG1LWDqkbPrV4D
-----END RSA PRIVATE KEY-----',
    'RS256'
);

INSERT INTO lti_registration VALUES(
    'ed514650-df77-403a-a3af-65d0ba44c51f',
    'https://lti-tool.elephango.com',
    'd42df408-70f5-4b60-8274-6c98d3b9468d',
    'https://lti-tool.elephango.com/platform/login.php',
    'https://lti-tool.elephango.com/platform/token.php',
    'https://lti-tool.elephango.com/platform/jwks.php',
    NULL,
    'd48a53de-021f-46f7-a0a4-7134812c2235'
);

INSERT INTO lti_registration VALUES(
    '01fb5042-0861-4828-bbf2-8f64ebf40752',
    'https://bwacademy-sandbox.mrooms.net',
    'mMnbwX1pTQ2dl0p',
    'https://bwacademy-sandbox.mrooms.net/mod/lti/auth.php',
    'https://bwacademy-sandbox.mrooms.net/mod/lti/token.php',
    'https://bwacademy-sandbox.mrooms.net/mod/lti/certs.php',
    NULL,
    'd48a53de-021f-46f7-a0a4-7134812c2235'
);

INSERT INTO lti_deployment VALUES(
    '8c49a5fa-f955-405e-865f-3d7e959e809f',
    'ed514650-df77-403a-a3af-65d0ba44c51f',
    'customer_1'
);

INSERT INTO lti_deployment VALUES(
    '31',
    '01fb5042-0861-4828-bbf2-8f64ebf40752',
    ''
);
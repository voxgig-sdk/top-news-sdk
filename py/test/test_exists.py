# ProjectName SDK exists test

import pytest
from topnews_sdk import TopNewsSDK


class TestExists:

    def test_should_create_test_sdk(self):
        testsdk = TopNewsSDK.test(None, None)
        assert testsdk is not None

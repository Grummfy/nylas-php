<?php namespace NylasTest;

/**
 * ----------------------------------------------------------------------------------
 * Draft Test
 * ----------------------------------------------------------------------------------
 *
 * @update lanlin
 * @change 2018/11/29
 */
class DraftTest extends Abs
{

    // ------------------------------------------------------------------------------

    public function testGetDraftList()
    {
        $data = self::$api->Drafts()->Draft()->getDraftsList();

        $this->assertTrue(count($data) > 0);
    }

    // ------------------------------------------------------------------------------

    public function testGetDraft()
    {
        $id = 'c5m5em1s3jd2ggsttf2zayzre';

        $data = self::$api->Drafts()->Draft()->getDraft($id);

        $this->assertArrayHasKey($id, $data);
    }

    // ------------------------------------------------------------------------------

    public function testAddDraft()
    {
        $params =
        [
            'subject' => 'loving you',
            'to'      => [['name' => '', 'email' => 'test@test.com']]
        ];

        $data = self::$api->Drafts()->Draft()->addDraft($params);

        $this->assertArrayHasKey('id', $data);
    }

    // ------------------------------------------------------------------------------

    public function testUpdateDraft()
    {
        $params =
        [
            'id'      => '70dwlz4bfstk68pc4c0ae5rxw',
            'version' => 4,
            'subject' => 'loving - you!!!',
            'to'      => [['name' => 'zhang san', 'email' => 'test@test.com']]
        ];

        $data = self::$api->Drafts()->Draft()->updateDraft($params);

        $this->assertArrayHasKey('id', $data);
    }

    // ------------------------------------------------------------------------------

    public function testDeleteDraft()
    {
        $params =
        [
            'id'      => '70dwlz4bfstk68pc4c0ae5rxw',
            'version' => 5
        ];

        try
        {
            $back = true;
            self::$api->Drafts()->Draft()->deleteDraft($params);
        }
        catch (\Exception $e)
        {
            $back = false;
        }

        $this->assertTrue($back);
    }

    // ------------------------------------------------------------------------------

    public function testSending()
    {
        $params =
        [
            'subject' => 'loving you',
            'to'      => [['name' => '', 'email' => 'test@test.com']]
        ];

        $draft = self::$api->Drafts()->Draft()->addDraft($params);

        $params =
        [
            'version'  => $draft['version'],
            'draft_id' => $draft['id'],
        ];

        $data = self::$api->Drafts()->Sending()->sendDraft($params);

        $this->assertArrayHasKey($draft['id'], $data);
    }

    // ------------------------------------------------------------------------------

}

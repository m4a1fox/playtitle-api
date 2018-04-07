<?php

namespace Playtitle;

class Playtitle extends Common
{
    public function activateUser(): array
    {
        return $this->sendRequest('activate');
    }

    /**
     * Get all available tags
     *
     * @return array
     */
    public function getTags(): array
    {
        return $this->sendRequest('tags');
    }

    /**
     * Get User Information
     *
     * @return array
     */
    public function getUser(): array
    {
        return $this->sendRequest('user');
    }

    /**
     * Get HTML code for tag
     *
     * @param integer $tagId
     * @return array
     */
    public function getHtmlForTag(integer $tagId): array
    {
        return $this->sendRequest('tag/html', ['tag_id' => $tagId]);
    }

    /**
     * Get search result
     *
     * @param array $keyValue
     * @return array
     */
    public function getSearchResult(array $keyValue): array
    {
        return $this->sendRequest('search', $keyValue);
    }

    /**
     * Get API key
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Get Playtitle Base Url
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
}
<?php

class Post
{
    public string $title = '';
    public string $content = '';
    public string $status = 'draft';
    public ?DateTimeImmutable $created_at = null;

    public function __construct(string $title = '', string $content = '')
    {
        $this->title = $title;
        $this->content = $content;
        $this->created_at = new DateTimeImmutable();
    }
}

class PostDuplicator
{
    private static function getTemplatePost(): Post
    {
        return new Post(
            title: 'Draft Template Post',
            content: 'Placeholder content for duplication.'
        );
    }

    // Store a callable reference in a constant (allowed).
    // Note: this is not a closure; it's an array callable that we call at runtime.
    public const DEFAULT_DRAFT_CLONE_FACTORY = [PostDuplicator::class, 'getTemplatePost'];

    public static function createNewDraft(string $newTitle): Post
    {
        // Call the callable at runtime, then clone the returned object
        $template = call_user_func(self::DEFAULT_DRAFT_CLONE_FACTORY);
        /** @var Post $newPost */
        $newPost = clone $template;

        $newPost->title = $newTitle;
        $newPost->created_at = new DateTimeImmutable();

        return $newPost;
    }
}

// --- Usage ---
$post1 = PostDuplicator::createNewDraft("First New Post");
$post2 = PostDuplicator::createNewDraft("Second New Post");

$post2->status = 'published';

echo "--- Post Duplication Results ---\n";
echo "Post 1 Status: {$post1->status}\n";
echo "Post 2 Status: {$post2->status}\n";
echo "Are Post 1 and Post 2 the same object? " . ($post1 === $post2 ? 'Yes' : 'No') . "\n";
